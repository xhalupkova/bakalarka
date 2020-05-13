var canvas = document.getElementById("render-canvas");

var engine = new BABYLON.Engine(canvas);

function setCookie(cname, cvalue, exdays) {
    let d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    let expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

//funkcia s nazvom 3d modelu ktory sa zobrazuje
BABYLON.SceneLoader.Load("./model/", "1stFloorD.babylon", engine, function (scene) {
    console.log(scene);
    //as this .babylon example hasn't camera in it, we have to create one
    var camera = new BABYLON.ArcRotateCamera("Camera", 1.57, 0.3, 14, new BABYLON.Vector3(-8.5, 0, 5), scene);
    //camera.setPosition(new BABYLON.Vector3(50, 20, 20));
    camera.wheelPrecision = 8.0;
    camera.attachControl(canvas, false);

    scene.clearColor = new BABYLON.Color4.FromHexString('#DADADA');
    scene.ambientColor = new BABYLON.Color3.White();

    //Light = PointLight - most basic, shining and spotlight in a given direction - svetlo musime mat aby sa videli farbi
    //var light = new BABYLON.PointLight("light", new BABYLON.Vector3(-10, -10, -10), scene); //1. arg = name, 2. arg = coordinates where to be in 3D space, 3. arg = scene, where we want to add it
    var light2 = new BABYLON.PointLight("light2", new BABYLON.Vector3(15, 15, 15), scene);

    canvas.addEventListener('click', () => {
        // We try to pick an object
        let result = scene.pick(scene.pointerX, scene.pointerY);

        if (result.hit) {
            $.ajax({
                method: 'GET',
                url: 'cubeInfo1', //funkcia ktora bude zapisovat do databazy
                data: {cubeId: result.pickedMesh.id},

                success: function (response) {

                    //setCookie('room', response[0].room)
                    console.log(result.pickedMesh.id);
                    //console.log(document.cookie);

                    setCookie('room', response[0].room)

                    $("#info").empty(); //empty() iba vymaze obsah div, remove zmazalo cely div
                    $("#info").append(response[0].room);

                    $("#people").empty();
                    $("#people").append(response[0].people);

                    if (response[0].room_type == 0) {
                        $("#reservation").empty();
                        const r = $('<button type="button" class="btn btn-outline-primary" onclick="window.location=\'./reservations/\'">Rezervovať</button>');

                        $("#reservation").append(r);

                    } else if (response[0].room_type == 1) {
                        $("#reservation").empty();
                        /*const r = $('<p>Kancelária - nie je možné rezervovať</p>');
                        $("#reservation").append(r);*/
                    }
                },
                failure: function (response) {
                    alert(response.responseText);
                },
                error: function (response) {
                    alert(response.responseText);
                }
            });

        }
    })

    var colors = ["#000000",
        "#FF7676",
        "#FF7676",
        "#E0FE47",
        "#66FE47",
        "#47FEB6",
        "#47EDFE",
        "#478FFE",
        "#6847FE",
        "#6400FF",
        "#D800FF",
        "#8D3F76",
        "#A60390",
        "#900C3F",
        "#FFC300",
        "#DAF7A6",
        "#C70039",
        "#FF5733",
        "#e5b224",
        "#927011",
        "#699211",
        "#11925a",
        "#119285",
        "#113192",
        "#4d1192",
        "#901192",
    ];

    for (i = 0; i < scene.meshes.length; i++) {
        //console.log(i);
        //console.log("var cube" + i + " = scene.getMeshByID('Cube" + i + "')");
        eval("var cube" + i + " = scene.getMeshByID('Cube" + i + "')");
        //console.log ("var material_cube" +  i + " = new BABYLON.StandardMaterial('material" + i + "', scene)");
        eval("var material_cube" + i + " = new BABYLON.StandardMaterial('material" + i + "', scene)");
        //console.log ("material_cube" + i + ".diffuseColor = new BABYLON.Color3.FromHexString('"+ colors[i] +"')");
        eval("material_cube" + i + ".diffuseColor = new BABYLON.Color3.FromHexString('" + colors[i] + "')");
        //console.log ("cube" + i + ".material = material_cube" + i);
        eval("cube" + i + ".material = material_cube" + i);


    }

    engine.runRenderLoop(function () { //runRenderLoop method -> executing renderLoopfunction(render indefinitly until told to stop)
        scene.render();
    });
});


