var domain_name = "http://localhost/quiz/";
$("#modechoose").modal({
    keyboard: false,
    backdrop: "static",
});
$("#validate_compatibility").modal("show");

function jump_to_question_number_on_page_load(questionList) {
    var last_question_submit = $("#last_question_submit").val();
    var foundQuestionNumber = "";
    $.each(questionList, function (index, value) {
        if (value.questionId == last_question_submit) {
            foundQuestionNumber = value.question_number;
            return false;
        }
    });
    if (foundQuestionNumber == "") {
        $(".questionListing_0").click();
        return false;
    } else {
        $(".questionListing_" + foundQuestionNumber).click();
        return false;
    }
    alert(".questionListing_" + foundQuestionNumber);
    return false;
}

function countColors(jsonArray) {
    // Define color aliases
    const colorAliases = {
        green: ["green"],
        red: ["red"],
        purple: ["purple_checked", "purple"],
        null: [null],
    };

    // Initialize color counts
    const colorCounts = {
        green: 0,
        red: 0,
        purple: 0,
        null: 0,
    };

    // Iterate through the JSON array
    jsonArray.forEach((item) => {
        const currentColor = item.color_class;

        // Increment count for each color type
        Object.keys(colorCounts).forEach((color) => {
            if (colorAliases[color].includes(currentColor)) {
                colorCounts[color]++;
            }
        });
    });

    // Log the counts for each color
    $(".green_box").html(colorCounts["green"]);
    $(".purple_box").html(colorCounts["purple"]);
    $(".red_box").html(colorCounts["red"]);
    $(".white__box").html(colorCounts["null"]);
}

function first_step() {
    $(".next_1").click(function () {
        $(".instructions_1").hide();
        $(".instructions_2").show();
        $(".footer_button_1").hide();
        $(".footer_button_2").show();
        $("#checkbeforeexam").parent("p").addClass("check_box_for_mocktest");
        $(".right_side_hide_show").css("display", "flex");
        countColors(questionList);
    });
}
first_step();
setHeighttoofmainDiv();

function pre_b_exam() {
    $(".instructions_1").show();
    $(".instructions_2").hide();
    $(".footer_button_1").show();
    $(".footer_button_2").hide();
}

function track_with_fun(page_url, dc, cm, type_page, remarks = 1) {
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        type: "POST",
        url: domain_name + "tracker_ajax",
        data: {
            page_url: page_url,
            dc: dc,
            cm: cm,
            page_type: page_type,
            remarks: remarks,
        },
        success: function (data) {},
    });
}

function setHeighttoofmainDiv() {
    if (window.matchMedia("(max-width: 767px)").matches) {
        $(".show_hide_on_mobile").addClass("collapse_new");
        $(".show_hide_on_mobile").addClass("");
        //$(".mobile_wrapper").height("300px");
        $(".mobile_wrapper").css("background", "#a5c3d2");
        $(".mobile_submit_button").fadeIn();
        $(".hide_in_mobile").fadeOut();
        $(".show_in_mobile").fadeIn();
        $(".mark-review").html("Mark & Next");
        $(".clear-response").html("Clear");
    } else {
        var body_height = parseFloat($("html").outerHeight());
        var header_height = parseFloat(
            $(".fixed-headerfor_height").outerHeight()
        );
        var footer_height = parseFloat($(".footer").outerHeight());
        var section_div = parseFloat($(".section_div").outerHeight());
        var main_div_height = parseFloat(
            body_height - (header_height + footer_height)
        );
        var height_of_questions = parseFloat(
            body_height - (header_height + section_div + section_div)
        );

        $(".dynamic_height").css("height", parseInt(main_div_height - 20));
        $(".right_fix_div").addClass("dn");
        $(".show-fix-first").addClass("dn");
        $(".test").css("display", "none");
        $(".mobile_submit_button").fadeOut();
        //$(".hide_in_mobile").fadeIn();
        $(".mark-review").html("Mark for Review & Next ");
        $(".clear-response").html("Clear Response");
        $(".fix-height").css("height", height_of_questions);
        $(".height_of_questio_option_div").css(
            "height",
            height_of_questions -
                (100 + footer_height + section_div + header_height)
        );
    }
}

function onlyonmobile() {
    if (window.matchMedia("(max-width: 767px)").matches) {
        $(".show_hide_on_mobile").addClass("dn");
    }
    /*else{
            $(".hide_in_mobile").addClass('dn');
        }*/
}

onlyonmobile();

function start_gmt_button() {
    if (monitor && cwc == false && checking_camera == true) {
        alert("Please Validte Your Face");
        return false;
    }
    if ($("#drop option:selected").val() == "") {
        alert("Please Select default Language.");
        return false;
    } else {
        if ($("#checkbeforeexam").prop("checked") == false) {
            alert("Please accept terms and Condition before proceeding.");
            return false;
        } else {
            $(".footer_button_2").css("display", "none"); // hiding the second button
            $(".footer_button_3").fadeIn(); //showing the div to start exam
            $(".footer_button_4").fadeIn(); //showing the div to start exam
            var language_selected = $("#drop option:selected").val();
            $("#language").val($.trim(language_selected)); //user will give test in english or hindi.
            var thislanguage = $("#drop option:selected").val();
            $("#find_if_dual_language").val(thislanguage);
            $("#start").click();
            start_the_gmt();
            $(".questions_main").fadeIn();
            $(".instructions_1").hide();
            $(".instructions_2").hide();
            $(".show_when_exam_start").css("display", "block");
            $("#change_laguage").val(language_selected);

            var question_number = 0;
            firstquestion_display(
                questionList,
                language_selected,
                question_number
            );
            var get_selected_section_id = $.trim($("#default_section").val());

            if (section_wise_or_not == 1) {
                $(".remove_dn_" + get_selected_section_id).removeClass("dn");
                var section_first_section_id = $("#default_section").val();
                $("#section_time").val(
                    $("#subjects_" + section_first_section_id).attr(
                        "data-section-time"
                    )
                );
            } else {
                $(".questionlisting").removeClass("dn");
            }
            $(".start_timer_stop_timer").click(); // timer will start here
            $(".start_stop_main_timer").click();
            single_question_timer(); //single question wala timer wala
            jump_to_question_number_on_page_load(questionList);
            $("#pause_mock_test").css("display", "block");
            $(".show-fix-first").removeClass("dn");

            if (window.matchMedia("(max-width: 767px)").matches) {
                $(".show_hide_on_mobile").addClass("dn");
                $(".hide_in_mobile").fadeOut();
            } else {
                $(".hide_in_mobile").fadeIn();
                //$(".hide_in_mobile").addClass('dn');
            }

            var get_the_language = $("#find_if_dual_language").val();
            $("#change_laguage").val(get_the_language).change();
        } // if every thing goes well.
    }
    if (monitor) {
        if (cwc != true) {
            document.getElementById("user_info").style.display = "none";
            video = document.getElementById("video1");
            video.classList.remove("d-none");
            $("#validate_body").empty();
            var stream = null;
            stream = navigator.mediaDevices
                .getUserMedia({
                    video: { facingMode: "user" },
                    audio: false,
                })
                .then((stream) => {
                    video.srcObject = stream;
                    video.controls = false;
                    video.play();
                })
                .catch((err) => {
                    console.log(err);
                });
            video.style.border = "solid 1px Green";
            checking_camera = false;
            console.log("camera accessed");
        }
        $("#pause_mock_test").hide();
        window.addEventListener("blur", function () {
            awaystarttime = new Date();
            const awayendtime = null;
            switch_ajax(awaystarttime, awayendtime, "tab");

            // console.log("the time is " + new Date());
            // $("#switchmodalok").click();
        });

        window.addEventListener("focus", function () {
            if (document.hasFocus()) {
                console.log("TAB CHANGE");
                switchmodal("tab");
                const awayendtime = new Date();
                // const timediff = awayendtime.getTime() - awaystarttime.getTime();
                // awayDuration = Math.floor(timediff / 1000);
                awaystarttime = null;
                // console.log("away duration: " + awayDuration + " seconds");
                switch_ajax(null, awayendtime, "tab");
            } else {
                awaystarttime = new Date();
                console.log("else part on coming back " + awaystarttime);
            }
        });
    }
} // end of the function

function switchmodal(type) {
    if (type == "tab") {
        var cc = getCkie("tab");
        if (cc == 5) {
            $("#switchmodalhead").text("Attention Required");
            $("#switchmodalline1").text(
                "Your exam has been suspended due to a detected switch away from the test window."
            );
            $("#switchmodal").modal("show");
            setCkie("tab", 0, 1);
            setTimeout(() => {
                submit_mocktest(1);
            }, 5000);
            return false;
        } else {
            setCkie("tab", parseInt(cc) + 1, 1);
            $("#switchmodalhead").text("âš ï¸");
            $("#switchmodalline1").text(
                "Please remain on this test page. Switching tabs will terminate your test."
            );
            $("#switchmodal").modal("show");
        }
    } else if ((type = "face")) {
        var fc = getCkie("onlyfans");
        if (fc == 3) {
            $("#switchmodalhead").text("Mocktest Suspended");
            $("#switchmodalline1").text("We noticed you were from the exam");
            $("#switchmodal").modal("show");
            setCkie("onlyfans", 0, 1);
            setTimeout(() => {
                submit_mocktest(1);
            }, 5000);

            return false;
        } else {
            setCkie("onlyfans", parseInt(fc) + 1, 1);
            $("#switchmodalhead").text("âš ï¸");
            $("#switchmodalline1").text("Please Stay focused On Your Screen");
            $("#switchmodal").modal("show");
        }
    }
}

function switch_ajax(awaystarttime, awayendtime, type) {
    var mt_id = $("#mocktest_enc_id").val();
    var question = $("#current_question_number").val();
    var questionid = $(".questionListing_" + question).attr("data-questionid");
    let mocktest_primary_key = $("#mocktest_primary_key").val();
    if (awayendtime == null) {
        console.log("User Gone " + awaystarttime);
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: domain_name + "mocktest_switch",
            type: "post",
            data: {
                mocktest_id: mocktest_primary_key,
                mt_id: mt_id,
                question: questionid,
                start: awaystarttime
                    .toISOString()
                    .slice(0, 19)
                    .replace("T", " "),
                end: null,
                type: type,
            },
            success: function (response) {},
        });
    } else {
        // console.log("User Came "+awayendtime);
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: domain_name + "mocktest_switch",
            type: "post",
            data: {
                mocktest_id: mocktest_primary_key,
                mt_id: mt_id,
                question: questionid,
                start: null,
                end: awayendtime.toISOString().slice(0, 19).replace("T", " "),
                type: type,
            },
            success: function (response) {},
        });
    }
}
var awaystarttime = null; // Variable to store the timestamp when the tab becomes hidden
let awayDuration = 0;

function start_the_gmt() {
    let mocktestid = $.trim($("#mocktest_enc_id").val());
    let selected_language_type = $.trim($("#language").val());
    let questions_option = $("#questions_option").val();
    console.log(questions_option);
    var suspend = 0;
    if (monitor) {
        suspend = -1;
    }
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: domain_name + "examtermsandconditionv3",
        type: "POST",
        data: {
            selected_language_type: selected_language_type,
            mocktestid: mocktestid,
            suspend: suspend,
            questions_option: questions_option,
        },
        success: function (data) {
            console.log(data);
            $("#mocktest_primary_key").val(data);
        },
    });
}

function start_stop_timer(start_stop, timer) {
    var interval = 1000,
        value = 0;

    if (start_stop == "start" && timer >= 0) {
        if (timer !== null) return;
        timer = setInterval(function () {
            value = value + 1;
            $("#input").val(value);
        }, interval);
        console.log(timer);
    }
}

function check_internet_connection() {
    if (!navigator.onLine) {
        $("#nointernetconnection").modal("show");
        return false;
    }
}

$(function () {
    var timer = null,
        interval = 1000,
        value = 0;

    $("#start").click(function () {
        if (timer !== null) return;
        timer = setInterval(function () {
            $("#input").val(++value);
        }, interval);
    });

    $("#stop").click(function () {
        clearInterval(timer);
        timer = null;
    });
});

function firstquestion_display(
    questionList,
    language_selected,
    question_number
) {
    $("#currentQuestion").val(questionList[question_number].question_number);
    $("#currentQuestionId").val(questionList[question_number].questionId);
    $("#current_subject").val(questionList[question_number].new_subject);
    $("#current_chapter").val(questionList[question_number].new_chapter);

    if (language_selected == "english") {
        var question_name = questionList[question_number].main_question;
        var options = questionList[question_number].options;
        if (questionList[question_number].group_question == "") {
            var question_direction =
                questionList[question_number].question_direction == ""
                    ? ""
                    : "<strong>    Direction</strong>" +
                      questionList[question_number].question_direction;
        } else {
            var question_direction =
                questionList[question_number].group_question == ""
                    ? ""
                    : "<strong>Direction</strong>" +
                      questionList[question_number].group_question;
        }
        var maderchod_options = questionList[question_number].options;
        var current_question_number =
            questionList[question_number].question_number;
        var new_subject = questionList[question_number].new_subject;
    } else {
        var question_name = questionList[question_number].main_question_hindi;
        var options = questionList[question_number].options_hindi;
        var maderchod_options = questionList[question_number].options_hindi;
        var current_question_number =
            questionList[question_number].question_number;
        var new_subject = questionList[question_number].new_subject;
        if (questionList[question_number].group_question == "") {
            var question_direction =
                questionList[question_number].question_direction_hindi == ""
                    ? ""
                    : "<strong>Direction</strong>" +
                      questionList[question_number].question_direction_hindi;
        } else {
            var question_direction =
                questionList[question_number].group_question_hindi == ""
                    ? ""
                    : "<strong>Direction</strong>" +
                      questionList[question_number].group_question_hindi;
        }
    }

    if (question_direction == "") {
        $(".question_div").css("display", "none");
        // $(".question_div").html(question_direction);
        $(".height_of_questio_option_div")
            .removeClass("col-sm-12 col-md-5 col-lg-6 col-xl-4")
            .addClass("col-sm-12 col-md-12 col-lg-12 col-xl-12 ");
        $(".question_with_directions").html(
            "<strong>Question:</strong>" + question_name
        );
    } else {
        $(".height_of_questio_option_div")
            .removeClass("col-sm-12 col-md-12 col-lg-12 col-xl-12")
            .addClass("col-sm-12 col-md-5 col-lg-6 col-xl-4");
        console.log("there is the scope of group direction");
        $(".question_div").css("display", "block");
        $(".question_div").html(question_direction);
        $(".question_with_directions").html(
            "<strong>Question:</strong>" + question_name
        );
    }

    $(".options_url").html(maderchod_options);
    $("#question_number").html(parseInt(current_question_number) + 1);
    $("#current_question_number").html(current_question_number);

    $(".marks").html("+ " + questionList[question_number].marks);
    $(".marks-negative").html(questionList[question_number].negative_marks);

    $(".box-ul li").removeClass("box-selected");
    $(".questionListing_" + question_number).addClass("box-selected");
    // removing the color from the sections and then applying it back
    $(".section_buttons").removeClass("section_button_selected");
    $("#subjects_" + new_subject).addClass("section_button_selected");
}

function ajax_call() {
    // var mocktest = '2596a54cdbb555cfd09cd5d991da0f55';
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: domain_name + "addquestionpost_test/" + mocktest,
        type: "POST",
        data: {
            answerSelectedArray2: answerSelectedArray2,
            selected_language_type2: selected_language_type2,
        },
        success: function (data) {
            $(".btn_change").css("display", "block");
            $(".loading-button").css("display", "none");
        },
        error: function (data) {
            answerSelectedArray2 = answerSelectedArray2;
            $(".btn_change").css("display", "block");
            $(".loading-button").css("display", "none");
        },
    });
}

function setcheckedvalue(currentId, option_selected) {
    $.each(questionList, function (key, values) {
        if (values.questionId == currentId) {
            questionList[key].answer_given = option_selected;
        }
    });
}

function selectradioongoingback(questionId) {
    var option_selected = "";
    $.each(questionList, function (key, values) {
        if (values.questionId == questionId) {
            option_selected = values.answer_given;
        }
    });
    $(
        "input[name='question_" +
            questionId +
            "'][value='" +
            option_selected +
            "']"
    ).attr("checked", true);
}

function change_color_on_numbers(question_number, color) {
    let array_count = parseInt(question_number) - 1;

    $(".questionListing_" + array_count).removeClass("green");
    $(".questionListing_" + array_count).removeClass("purple");
    $(".questionListing_" + array_count).removeClass("red");
    $(".questionListing_" + array_count).removeClass("purple_checked");

    $(".questionListing_" + array_count).addClass(color);
    questionList[array_count].color_class = color;
}

function single_question_timer() {
    var timeinterval = setInterval(function () {
        gettime = parseInt($("#single_time").html());
        gettime = gettime + 1;
        $("#single_time").html(gettime);
    }, 1000);
    return timeinterval;
}

function showStatus(status) {
    if (status == "false") {
        //internet not working properly
        // $(".demo_button_for_internet").click();
        // /*$("#pause_mock_test").click(); */

        $("#pauseBtnhms").click();

        // $("#no-internet").click();
    }
}

function checkinternetconnection() {
    // 1st, we set the correct status when the page loads
    navigator.onLine ? showStatus(true) : showStatus(false);
    // now we listen for network status changes
    window.addEventListener("online", () => {
        showStatus(true);
    });

    window.addEventListener("offline", () => {
        showStatus(false);
        $("#pauseBtnhms").click();

        $("#no_internet_modal").modal({
            backdrop: "static",
            keyboard: false,
        });
        $("#no_internet_modal").modal("show");
    });
}

function escapeHtml(text) {
    var map = {
        "&": "&amp;",
        "<": "&lt;",
        ">": "&gt;",
        '"': "&quot;",
        "'": "&#039;",
    };
    return text.replace(/[&<>"']/g, function (m) {
        return map[m];
    });
}

function ajaxcall() {
    let language = $("#language").val();
    var this_question_number = parseInt($("#previous_question_number").val());
    let mocktest_enc_id = $.trim($("#mocktest_enc_id").val());
    let mocktest_id = $.trim($("#mocktest_id").val());
    let question_id = questionList[this_question_number].questionId;
    let chapter_id = questionList[this_question_number].new_chapter;
    let subject_id = questionList[this_question_number].new_subject;
    let time_taken = parseInt($("#single_time").text());
    let color = questionList[this_question_number].color_class;
    if (color == "red") {
        var answer_given = -1;
    } else {
        var answer_given = questionList[this_question_number].answer_given;
    }
    let mocktest_primary_key = $("#mocktest_primary_key").val();
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: domain_name + "save_gmt_question/" + mocktest_enc_id,
        type: "post",
        data: {
            language: language,
            mocktest_enc_id: mocktest_enc_id,
            mocktest_id: mocktest_id,
            question_id: question_id,
            answer_given: answer_given,
            subject_id: subject_id,
            chapter_id: chapter_id,
            time_taken: time_taken,
            color: color,
            mocktest_primary_key: mocktest_primary_key,
        },
        success: function (data) {},
    });
    var crt_qus = $("#current_question_number").text();
    var ttl_qus = $("#total_question").val();
    console.log(answer_given);
    if (ttl_qus - crt_qus == 1 && answer_given != -1) {
        $(".submit_exam").click();
    }
    $("#ques_time_when_click_on_number").val("");
}

function getCookie(cname) {
    let name = cname + "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(";");
    for (let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) == " ") {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

function submit_mocktest(suspend = 0) {
    let language = $("#language").val();
    let mocktest_enc_id = $.trim($("#mocktest_enc_id").val());
    let mocktest_id = $.trim($("#mocktest_id").val());
    let back_to_course = $.trim($("#back_to_course").val());
    let reattampt_for_beecoin = $("#reattampt_for_beecoin").val();
    let paid_mock = $("#paid_mock").val();
    if (monitor && suspend == 0) {
        suspend = 2;
    }
    $(".close").click();
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: domain_name + "gmt_submit/" + mocktest_enc_id,
        type: "post",
        data: {
            language: language,
            mocktest_enc_id: mocktest_enc_id,
            mocktest_id: mocktest_id,
            reattampt_for_beecoin: reattampt_for_beecoin,
            paid_mock: paid_mock,
            suspend: suspend,
        },
        success: function (data) {
            $(".overlay").css("display", "block");
            $(".overlay").css("display", "block");
            $(".loading-div").css("display", "block");
            var descriptive_id = $("#descriptive_mocktest").val();
            var redirect_another_id = $("#redirect_another_id").val();

            if (
                descriptive_id == 0 ||
                descriptive_id == "" ||
                descriptive_id == "0"
            ) {
                window.location.href =
                    domain_name +
                    "feedback/" +
                    mocktest_enc_id +
                    "?back-to-course=" +
                    back_to_course;
            } else {
                window.location.href = descriptive_id;
            }
        },
    });
}

function all_work_here(color) {
    $("#previous_question_number").val($("#current_question_number").val());
    var total_question = $("#total_question").val();
    var question_number = parseInt($("#current_question_number").val()) + 1;
    var language_selected = $("#drop option:selected").val();

    if (total_question - 1 == $("#current_question_number").val()) {
        ajaxcall();
        if (color != "") {
            change_color_on_numbers(question_number, color);
            $("#single_time").html(parseInt(0));
        }
    } else {
        $("#current_question_number").val(question_number);
        firstquestion_display(questionList, language_selected, question_number);
        $(".questionListing_" + question_number).attr("data-questionid");
        selectradioongoingback(
            $(".questionListing_" + question_number).attr("data-questionid")
        );
        ajaxcall();
        if (color != "") {
            change_color_on_numbers(question_number, color);
            $("#single_time").html(parseInt(0));
        }
    }
}

function img_width_set() {
    if (window.matchMedia("(max-width: 767px)").matches) {
        $(".question_with_directions img").each(function () {
            var img_width = $(this).width();
            if (img_width > 300 || img_width == 0) {
                //$(".question_div img").css('width', '500px');
                $(".question_with_directions img").css("width", "100%");
            } else {
                $(".question_with_directions img");
            }
        });
    }
}

function get_section_data(question_array, section_name, type) {
    // get_section_data
    var section_question_count = 0;
    var section_answer_count = 0;
    var total_question_answered = 0;

    $.each(question_array, function (key, values) {
        if (
            type == "no_of_questions" &&
            questionList[key].subject_name == section_name
        ) {
            section_question_count = section_question_count + 1;
        }

        if (
            type == "no_of_question_answered" &&
            questionList[key].subject_name == section_name &&
            questionList[key].answer_given != -1 &&
            questionList[key].color_class == "green"
        ) {
            section_question_count = section_question_count + 1;
        }

        if (
            type == "not_answered" &&
            questionList[key].subject_name == section_name &&
            questionList[key].answer_given == -1 &&
            questionList[key].color_class == "red"
        ) {
            section_question_count = section_question_count + 1;
        }

        if (
            type == "answered_marked" &&
            questionList[key].subject_name == section_name &&
            (questionList[key].color_class == "purple_checked" ||
                questionList[key].color_class == "purple")
        ) {
            section_question_count = section_question_count + 1;
        }

        if (
            type == "not_visited" &&
            questionList[key].subject_name == section_name &&
            (questionList[key].color_class == null ||
                questionList[key].color_class == "null") &&
            questionList[key].answer_given == -1
        ) {
            section_question_count = section_question_count + 1;
        }

        /* if(type == "not_answered" && questionList[key].subject_name == section_name && questionList[key].answer_given != -1){
           section_question_count = (section_question_count+1); 
         }*/
    });

    return section_question_count;
    // no_of_answers
}
var monitor = false;
function monitormode(e) {
    monitor = e;
    $("#monitorclose").click();
    cam_on();
    $("#validate_compatibility").modal({
        keyboard: false,
        backdrop: "static",
    });
}
jQuery(document).ready(function ($) {
    // let current_question_number = $.trim(parseInt($("#current_question_number").val()));
    // let answer_given_status = $.trim(parseInt(questionList[current_question_number].answer_given));
    // $("#modechoose").modal("hide");
    $("#change_laguage").click(function () {
        var select_language = $(this).find(":selected").val();
        $("#previous_question_number").val($("#current_question_number").val());
        var total_question = $("#total_question").val();
        var question_number = parseInt($("#current_question_number").val());
        var language_selected = $("#drop option:selected").val();

        if (select_language == "english") {
            // is for english
            firstquestion_display(questionList, "english", question_number);
            selectradioongoingback(
                $(".questionListing_" + question_number).attr("data-questionid")
            );
        } else if (select_language == "hindi") {
            // is for hindi
            firstquestion_display(questionList, "hindi", question_number);
            selectradioongoingback(
                $(".questionListing_" + question_number).attr("data-questionid")
            );
        } else {
            var default_language = $("#find_if_dual_language").val();
            firstquestion_display(
                questionList,
                "default_language",
                question_number
            );
            selectradioongoingback(
                $(".questionListing_" + question_number).attr("data-questionid")
            );
        }
    });

    $(".save-next").click(function () {
        var timeValue = parseInt($("#single_time").text());
        checkinternetconnection();
        var get_the_language = $("#find_if_dual_language").val();
        $("#change_laguage").val(get_the_language).change();

        let current_question_number = $.trim(
            parseInt($("#current_question_number").val())
        );
        let answer_given_status = $.trim(
            parseInt(questionList[current_question_number].answer_given)
        );

        if (
            parseInt(answer_given_status) == -1 ||
            parseInt(answer_given_status == "")
        ) {
            var color = "red";
        } else {
            var color = "green";
        }

        questionList[current_question_number].color_class = color;
        all_work_here(color);
        img_width_set();

        drop_down = $("#language").val();
        $("#change_laguage").val(drop_down);
        countColors(questionList);
    });

    $(".questionlisting").click(function () {
        // Get the value of the div and convert it to an integer
        var timeValue = parseInt($("#single_time").text());
        $("#ques_time_when_click_on_number").val(timeValue);
        checkinternetconnection();
        var get_the_language = $("#find_if_dual_language").val();
        $("#change_laguage").val(get_the_language).change();

        $("#previous_question_number").val(
            parseInt($("#current_question_number").val())
        );
        var current_question = $(this).attr("data-value");
        $("#current_question_number").val(parseInt(current_question));
        var total_question = $("#total_question").val();
        var language_selected = $("#drop option:selected").val();
        var question_number = parseInt($("#current_question_number").val());
        if (total_question == $("#current_question_number").val()) {
            ajaxcall();
        } else {
            var timeValue = parseInt($("#single_time").text());
            firstquestion_display(
                questionList,
                language_selected,
                question_number
            );
            $(".questionListing_" + question_number).attr("data-questionid");
            selectradioongoingback(
                $(".questionListing_" + question_number).attr("data-questionid")
            );
            var color =
                questionList[parseInt($("#previous_question_number").val())]
                    .color_class;
            var old_question_number =
                parseInt($("#previous_question_number").val()) + 1;
            var timeValue = parseInt($("#single_time").text());
            if (
                color == null ||
                color == "" ||
                color == "null" ||
                color === null
            ) {
                let color_new = "red";
                change_color_on_numbers(old_question_number, color_new);
            } else {
                let color_new = color;
                change_color_on_numbers(old_question_number, color_new);
            }
            ajaxcall();
            $("#single_time").html(parseInt(0));
        }
        img_width_set();

        // var img = $(".question_div").find("img").map(function () {
        //     var x = get_hostname($(this).attr('src'));
        //     console.log(x);
        //     var x = get_hostname($(this).attr('src'));
        //     if(x == 'http://www.imathas.com'){
        //         $(this).css('width', 'auto');
        //     }
        //     }).get();
        var img = $(".container-fluid")
            .find("img")
            .map(function () {
                var x = get_hostname($(this).attr("src"));
                if (x == "http://www.imathas.com") {
                    $(this).css("width", "auto");
                }
            })
            .get();
        countColors(questionList);
    });

   

    $(".section_buttons").click(function () {
        var section_tab_clicked = $(this).attr("data-first_question");
        section_tab_clicked = section_tab_clicked;
        $(".questionListing_" + section_tab_clicked).click();
    });

    $("#start_stop_main_timer").click(function () {
        var timesplit = $("#mocktest_total_time").val().split(":");
        var time_hours = timesplit[0];
        var time_min = timesplit[1];
        var time_second = timesplit[2];
        $("#hms_timer_duplicate").countdowntimer({
            hours: time_hours,
            minutes: time_min,
            seconds: time_second,
            size: "lg",
            pauseButton: "pauseBtnhms",
            stopButton: "stopBtnhms",
            timeUp: timeisUp,
        });
    });

    function timeisUp() {
        $("#submit_test").click();
    }

    $(".submit_exam").click(function () {
        var final_array = questionList;
        $("#table_for_submit").html("");
        var x =
            "<tr>" +
            "<td><strong>Sections</strong></td>" +
            "<td><strong>No of Question</strong></td>" +
            "<td><strong>Answered</strong></td>" +
            "<td><strong>Not Answered</strong></td>" +
            "<td><strong>Marked for Review</strong></td>" +
            "<td><strong>Not Visited</strong></td>" +
            "</tr>";
        $("#table_for_submit").append(x);
        $.each(subject_array_question_wise, function (key, values) {
            //console.log(values);
            var x =
                "<tr>" +
                "<td><strong>" +
                values +
                "</strong></td>" +
                "<td>" +
                get_section_data(questionList, values, "no_of_questions") +
                "</strong></td>" +
                "<td>" +
                get_section_data(
                    questionList,
                    values,
                    "no_of_question_answered"
                ) +
                "</strong></td>" +
                "<td>" +
                get_section_data(questionList, values, "not_answered") +
                "</strong></td>" +
                "<td>" +
                get_section_data(questionList, values, "answered_marked") +
                "</strong></td>" +
                "<td>" +
                get_section_data(questionList, values, "not_visited") +
                "</strong></td>" +
                "</tr>";
            $("#table_for_submit").append(x);
        });
        $("#submit_mocktest").click();
    });

    $(".report-issue").click(function () {
        $("#report_an_issue_id").click();
        $("#report_question_issue").html("");
        var current_question = parseInt($("#current_question_number").val());
        var question = questionList[current_question].main_question;
        $("#report_question_issue").html(question);
    });

    $(".error_submit").click(function () {
        var questionId = $(
            ".questionListing_" + $("#current_question_number").val()
        ).attr("data-questionid"); // parseInt($.trim($("#current_question_number").val()));
        let mocktest_enc_id = $.trim($("#mocktest_enc_id").val());
        var error_description = $.trim($("#report_issue").val());
        var issue = $.trim($("#id_issuereprt").val());

        if (error_description == "") {
            $("#report_issue").css("border", "1px solid red");
            alert("Please enter the issue or bug");
            return false;
        }

        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: domain_name + "report_error",
            type: "POST",
            data: {
                question_id: questionId,
                mocktest_id: mocktest_enc_id,
                error_description: error_description,
                issue: issue,
            },
            success: function (data) {
                //console.log(data);
                $("#report_issue_triger").modal("hide");
                $(".pause_dialog_close_error").click();
            },
        });
    });

    $("#pause_mock_test").click(function () {
        $("#pauseBtnhms").click();
        $("#pause_mocktest_button").click();
        var time_spend_on_question = parseInt($("#single_time").html());
        $("#save_single_question_timer_on_pause").html(
            parseInt(time_spend_on_question)
        );
        let mocktest_enc_id = $.trim($("#mocktest_enc_id").val());
        let current_question = $.trim($("#current_question_number").val());
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: domain_name + "pause_mocktest",
            type: "POST",
            data: {
                mocktest_enc_id: mocktest_enc_id,
                current_question: current_question,
            },
            success: function (data) {
                /*$(".pause_dialog_close_error").click();*/
                console.log("Pause");
                // console.log(data);
            },
        });
    });

    $("#pause_mocktest").modal({
        show: false,
        backdrop: "static",
    });

    // $("#no_internet_modal").modal({
    //     show: false,
    //     backdrop: 'static'
    // });

    $("#resume_mock_test").click(function () {
        $("#pauseBtnhms").click();
        $(".close").click();
        $(".pause_dialog_close").click();
        var time_on_this_question = parseInt(
            $("#save_single_question_timer_on_pause").html()
        );
        $("#single_time").html(time_on_this_question);
        let mocktest_enc_id = $.trim($("#mocktest_enc_id").val());
        let current_question = $.trim($("#current_question_number").val());
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: domain_name + "resume_mock_test",
            type: "POST",
            data: {
                mocktest_enc_id: mocktest_enc_id,
                current_question: current_question,
            },
            success: function (data) {
                /*$(".pause_dialog_close_error").click();*/
                console.log("resomed mocktest");
                // console.log(data);
            },
        });
    });

    $(".right_fix_div").click(function () {
        $(".collapse_new").addClass("collapse_show");
        $(".show-fix-first").addClass("dn");
        $(".hide-fix-first").removeClass("dn");
        $(".overlay_mobile").css("display", "block");
        $("collapse_new").removeClass("dn");
        $(".collapse_new").removeClass("dn");
    });

    $(".hide-fix-first").click(function () {
        $(".collapse_new").removeClass("collapse_show");
        $(".show-fix-first").removeClass("dn");
        $(".hide-fix-first").addClass("dn");
        $(".overlay_mobile").css("display", "none");
        $("collapse_new").addClass("dn");
    });
}); // end of document .ready

function get_hostname(url) {
    var m = url.match(/^http:\/\/[^/]+/);
    return m ? m[0] : null;
}

function setCkie(c_name, value, exdays) {
    var exdate = new Date();
    exdate.setDate(exdate.getDate() + 1);
    var c_value =
        escape(value) +
        (exdays == null ? "" : "; expires=" + exdate.toUTCString());
    document.cookie = c_name + "=" + c_value;
}
setCkie("tab", 0, 1);
setCkie("onlyfans", 0, 1);
function getCkie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(";");
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == " ") {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}
