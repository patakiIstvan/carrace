const makeCars = {
    functionname: 'makeCars',
    carNum: 6
}
const moveCars = {
    functionname: 'moveCars'
}

function clientResponse(funct, data) {
    switch (funct) {
        case "makeCars":
            console.log(data);
            $('.racetrack').empty();
            data["cars"].forEach(car => {
                const moveRotation = car["distance"] / 100 * 360 * car["maxLap"];
                $('.racetrack').append(
                    `<div class="racer">
                   <div style="
                   right: ${car["placement"]*40}px; 
                   background-color: ${car["color"]};
                   transform: translateY(-50%) rotate(${moveRotation}deg);
                   " class="current-pos">
                   </div>
                   </div>`
                )
            });
            break;
            case "moveCars":
            console.log("WTF are you trying to do?")
            break;
        default:
            console.log("unknown function");
    }

}

function sendServerData(path, funct) {
    $.post(path, funct,
        function (data, status) {
            clientResponse(funct["functionname"], JSON.parse(data))
        });
}

$(".start-button").click(function () {
    sendServerData("init.php", makeCars);
    setTimeout(function () {
        sendServerData("init.php", moveCars);
    }, 5000);
});