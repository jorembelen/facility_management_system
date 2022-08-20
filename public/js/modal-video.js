$(document).ready(function() {

    // Gets the video src from the data-src on each button

    var $videoSrc;
    $('.login-video-btn').click(function() {
        $videoSrc = $(this).data( "src" );
    });
    console.log($videoSrc);

    // when the modal is opened autoplay it
    $('#loginModal').on('shown.bs.modal', function (e) {

        // set the video src to autoplay and not to show related video. Youtube related video is like a box of chocolates... you never know what you're gonna get
        $("#login-video").attr('src',$videoSrc + "?autoplay=1&amp;modestbranding=1&amp;showinfo=0");

    })

    // stop playing the youtube video when I close the modal
    $('#loginModal').on('hide.bs.modal', function (e) {
        // a poor man's stop video
        $("#login-video").attr('src',$videoSrc);
    })

    // For Appointment Creation
    var $createVideoSrc;
    $('.create-video-btn').click(function() {
        $createVideoSrc = $(this).data( "src" );
    });
    console.log($createVideoSrc);

    // when the modal is opened autoplay it
    $('#createModal').on('shown.bs.modal', function (e) {

        // set the video src to autoplay and not to show related video. Youtube related video is like a box of chocolates... you never know what you're gonna get
        $("#create-video").attr('src',$createVideoSrc + "?autoplay=1&amp;modestbranding=1&amp;showinfo=0");

    })

    // stop playing the youtube video when I close the modal
    $('#createModal').on('hide.bs.modal', function (e) {
        // a poor man's stop video
        $("#create-video").attr('src',$createVideoSrc);
    })

    // For Survey Creation
    var $surveyVideoSrc;
    $('.survey-video-btn').click(function() {
        $surveyVideoSrc = $(this).data( "src" );
    });
    console.log($surveyVideoSrc);

    // when the modal is opened autoplay it
    $('#surveyModal').on('shown.bs.modal', function (e) {

        // set the video src to autoplay and not to show related video. Youtube related video is like a box of chocolates... you never know what you're gonna get
        $("#survey-video").attr('src',$surveyVideoSrc + "?autoplay=1&amp;modestbranding=1&amp;showinfo=0");

    })

    // stop playing the youtube video when I close the modal
    $('#surveyModal').on('hide.bs.modal', function (e) {
        // a poor man's stop video
        $("#survey-video").attr('src',$surveyVideoSrc);
    })

    // For Logout
    var $logoutVideoSrc;
    $('.logout-video-btn').click(function() {
        $logoutVideoSrc = $(this).data( "src" );
    });
    console.log($logoutVideoSrc);

    // when the modal is opened autoplay it
    $('#logoutModal').on('shown.bs.modal', function (e) {

        // set the video src to autoplay and not to show related video. Youtube related video is like a box of chocolates... you never know what you're gonna get
        $("#logout-video").attr('src',$logoutVideoSrc + "?autoplay=1&amp;modestbranding=1&amp;showinfo=0");

    })

    // stop playing the youtube video when I close the modal
    $('#logoutModal').on('hide.bs.modal', function (e) {
        // a poor man's stop video
        $("#logout-video").attr('src',$logoutVideoSrc);
    })

    // document ready
});
