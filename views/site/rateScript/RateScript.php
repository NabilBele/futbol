        <script>
function ValHandler() {
    let proBar = Array.from(document.getElementsByClassName("votes-count")).map(e => parseInt(e
        .textContent.trim()));

    let maxVotes = Math.max(...proBar);

    const progressBars = Array.from(document.getElementsByClassName("progress-bar"));

    for (let x = 0; x < progressBars.length; x++) {
        if (proBar.indexOf(maxVotes) === x) {
            progressBars[x].style.width = "100%";
        } else {
            let perCentWidth = (proBar[x] / maxVotes) * 100;
            progressBars[x].style.width = `${perCentWidth}%`;
        }
    }
}

// Call the ValHandler function after the HTML markup is rendered
window.addEventListener("DOMContentLoaded", ValHandler);
        </script>