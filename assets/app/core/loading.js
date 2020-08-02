document.onreadystatechange = () => {
    let state = document.readyState;
    if (state == 'interactive') {
    } else if (state == 'complete') {
        $("#loader3").delay(1000).fadeOut("slow");
    }
}
