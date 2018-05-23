function process() {
    for (var i = 0; i < 4; i++) {
        var $processbarBiuld = $("div #processbarBiuld" + i);
        var $date = $("div #date" + i);
        var $versionNum = $("div #versionNum" +i);
        process1($processbarBiuld, $date, $versionNum, i);
    }
}
function process1(processbarBiuld, date, versionNum,item) {
    $(processbarBiuld).load("buildProcess.php", {jobName: config.jobName[item]}, function(response, status, xhr) {
        if (status == "success") {
            result = $(this).text().trim().split("|");
            switch (result[0]) {
                case 'Failed' :
                    $(processbarBiuld).html(result[0] + "|" + result[1]).width("100%").attr("class", "processbarBiuldF");
                    $(date).html(result[2]);
					$(versionNum).html("版本号：" + result[3]);
                    break;
                case 'Success' :
                    $(processbarBiuld).html("100%|" + result[1]).width("100%").attr("class", "processbarBiuld");
                    $(date).html(result[2]);
					$(versionNum).html("版本号：" + result[3]);
                    break;
                case 'Unstable' :
                    $(processbarBiuld).html(result[0] + "|" + result[1]).width("100%").attr("class", "processbarBiuldF");
                    $(date).html(result[2]);
                    break;
                case 'Aborted' :
                    $(processbarBiuld).html(result[0] + "|" + result[1]).width("100%").attr("class", "processbarBiuldA");
                    $(date).html(result[2]);
                    break;
                case 'Wating' :
                    $(processbarBiuld).html(result[0] + "|" + result[1]).width("100%").attr("class", "processbarBiuld");
                    $(date).html(result[2]);
                    break;
                default :                          
                    percent = parseInt(result[0]) + "%";                    
                    if (percent == "NaN%"){
                        result[1] = ""
                        $(processbarBiuld).html("").width(percent).attr("class", "processbarBiuld");
                        break;
                    }                        
                    $(processbarBiuld).html(percent + "|" + result[1]).width(percent).attr("class", "processbarBiuld");
                    $(date).html(result[2]);
                    $(versionNum).html("版本号：生成中....");
                    break;
            }
            if (processbarBiuld.text() == "100%" | processbarBiuld.text() == "Failed" | processbarBiuld.text() == "Unstable" | processbarBiuld.text() == "Aborted") {
                window.clearInterval(bartimerBiuld);
            }
        }
    });

}
function setProcess() {
    var processbar = document.getElementById("processbar");
    processbar.style.width = parseInt(processbar.style.width) + 1 + "%";
    processbar.innerHTML = processbar.style.width;
    if (processbar.style.width == "100%") {
        window.clearInterval(bartimer);
    }
}
function cloudAutoTest() {
    var $processbarAutoTest = $("div #processbarAutoTest");
    var $processbarSmokeTest = $("div #processbarSmokeTest");
    var softVersion = "";
    $.ajax({
        type: "GET",
        url: "http://192.168.162.42:9801/all_tasks_h/verbose",
        dataType: "jsonp",
        success: function(json) {
            $.each(json, function(index, content) {
                for (var i = 0; i < 4; i++) {
                    if (content.parent_name == config.smokeParentName[i].trim()) {
                        var $processbarSmokeTest = $("div #processbarSmokeTest" + i);
                        testProcess(content, $processbarSmokeTest, bartimerAutoTest);
                    }
                    if (content.parent_name == config.autoParentName[i].trim()) {
                        var $processbarAutoTest = $("div #processbarAutoTest" + i);
                        testProcess(content, $processbarAutoTest, bartimerAutoTest);

                    }
                }

            })
        }
    });
}
function testProcess(content, bar, bartime) {
    var run_count = 0, running = 0, need_run = 0, result = 0, percent = 0, run_time = 0;
    brief = "已结束";
    $.each(content, function(index, subContent) {
        if (index == "sub_task_data") {
            $.each(subContent, function(indexSubTaskData, subTaskDataContent) {
                run_time = "|" + subTaskDataContent.run_time + "min";
                if (subTaskDataContent.brief == "镜像制作中") {
                    brief = "镜像制作中";
                } else if (subTaskDataContent.brief == "等待运行") {
                    brief = "等待运行";
                } else if (subTaskDataContent.brief == "运行中") {
                    run_count += subTaskDataContent.all_resources[0].run_count;
                    running += subTaskDataContent.all_resources[0].running;
                    need_run += subTaskDataContent.all_resources[0].need_run;
                    brief = "运行中";
                }
            })
        }
    })
    result = run_count / (run_count + running + need_run);
    percent = parseInt(result * 100) + "%"
    switch (brief) {
        case '已结束':
            bar.width("90").text("100%" + run_time).attr("class", "processbarBiuld");
            break;
        case '镜像制作中':
            bar.width("90").text("Mirroring" + run_time).attr("class", "processbarTestWaiting");
            break;
        case '等待运行':
            bar.width("90").text("Waiting" + run_time).attr("class", "processbarTestWaiting");
            break;
        default:
            if (percent == "NaN%")
                percent = "0%";
            bar.width(percent).text(percent + run_time).attr("class", "processbarBiuld");
            break;
    }
}
var bartimer = window.setInterval(function() {
    setProcess();
}, 10000);
var bartimerBiuld = window.setInterval(function() {
    process();
}, 1000);
var bartimerAutoTest = window.setInterval(function() {
    cloudAutoTest();
}, 1000);

$(function() {
    bartimer;
    bartimerBiuld;
    bartimerAutoTest;
});


