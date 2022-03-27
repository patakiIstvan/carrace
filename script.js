const makeCars = {
    functionname: 'makeCars',
    carNum: 3
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
                    `<div id="car${car["placement"]}" class="racer"
                    style=" transform: translateY(-50%) rotate(-${moveRotation}deg);">
                   <div style="
                   right: ${car["placement"]*40}px; 
                   background-color: ${car["color"]};
                   " class="current-pos">
                   </div>
                   </div>`
                )
            });
            break;
            case "moveCars": 
            console.log("car moving WROM WROM")
            console.log(data)
            const numOfCars = $('.racetrack').children().length;
            const moveRotation = 240;
            for (let i=1; i <= numOfCars; i++){
                $(`#car${i}`).css("transform", `translateY(-50%) rotate(-${moveRotation}deg)`);
            }
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
    }, 500);
});