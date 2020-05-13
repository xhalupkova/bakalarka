
var canvas = document.getElementById("render-canvas");

var engine = new BABYLON.Engine(canvas);

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

//funkcia s nazvom 3d modelu ktory sa zobrazuje
BABYLON.SceneLoader.Load("./model/", "2ndFloorD.babylon", engine, function (scene) {
    //console.log(scene);
    //as this .babylon example hasn't camera in it, we have to create one
    var camera = new BABYLON.ArcRotateCamera("Camera", 1.57, 0.3, 12, new BABYLON.Vector3(1.5, 0, -0.4), scene);
    //camera.setPosition(new BABYLON.Vector3(0, 13, 2));
    camera.wheelPrecision = 8.0;
    camera.attachControl(canvas, false);

    scene.clearColor = new BABYLON.Color4.FromHexString('#DADADA');
    scene.ambientColor = new BABYLON.Color3.White();

    //Light = PointLight - most basic, shining and spotlight in a given direction - svetlo musime mat aby sa videli farbi
    var light = new BABYLON.PointLight("light", new BABYLON.Vector3(-10, -10, -10), scene); //1. arg = name, 2. arg = coordinates where to be in 3D space, 3. arg = scene, where we want to add it
    var light2 = new BABYLON.PointLight("light2", new BABYLON.Vector3(10, 10, 10), scene);

    //const highlight = new BABYLON.HighlightLayer('highlight', scene);

    // Pick mesh by clicking the canvas
    canvas.addEventListener('click', () => {
        // We try to pick an object
        let result = scene.pick(scene.pointerX, scene.pointerY);

        if (result.hit) {
            $.ajax({
                method: 'GET',
                url: 'cubeInfo2', //funkcia ktora bude zapisovat do databazy
                data: {cubeId: result.pickedMesh.id},

                success: function (response) {

                    //setCookie('room', response[0].room)
                    //console.log(response);
                    console.log(result.pickedMesh.id);

                    setCookie('room', response[0].room)

                    $("#info").empty(); //empty() iba vymaze obsah div, remove zmazalo cely div
                    $("#info").append(response[0].room);

                    $("#people").empty();
                    $("#people").append(response[0].people);

                    if (response[0].room_type == 1) {
                        $("#reservation").empty();
                        const r = $('<button type="button" class="btn btn-outline-primary" onclick="window.location=\'./reservations/\'">Rezervovať</button>');

                        $("#reservation").append(r);

                    } else if (response[0].room_type == 0) {
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

    var colors = ["#FF7676",
        "#FF7676",
        "#b6a507",
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
        "#b62107",
        "#991c06",
        "#C70039",
        "#900C3F",
        "#FF5733",
        "#e5b224",
        "#927011",
        "#699211",
        "#11925a",
        "#119285",
        "#113192",
        "#4d1192",
        "#901192"];

    console.log(scene.meshes.length);
    let j = 0;
    for (let i = 26; i < 26 + scene.meshes.length; i++) {


        //console.log("var cube" + i + " = scene.getMeshByID('Cube" + i + "')");
        eval("var cube" + i + " = scene.getMeshByID('Cube" + i + "')");
        //console.log ("var material_cube" +  i + " = new BABYLON.StandardMaterial('material" + i + "', scene)");
        eval("var material_cube" + i + " = new BABYLON.StandardMaterial('material" + i + "', scene)");
        //console.log ("material_cube" + i + ".diffuseColor = new BABYLON.Color3.FromHexString('"+ colors[j] +"')");
        eval("material_cube" + i + ".diffuseColor = new BABYLON.Color3.FromHexString('" + colors[j] + "')");
        //console.log ("cube" + i + ".material = material_cube" + i);
        eval("cube" + i + ".material = material_cube" + i);
        j++;

    }



    //  *text na objekt*

    /*
        var box = scene.getMeshByID("Cube0");

        var textCanvas = document.createElement('canvas');
        textCanvas.width = 512;
        textCanvas.height = 512;

        //the material of the box with ambientTexture and diffuseTexture
        var boxMaterial = new BABYLON.StandardMaterial("texture", scene);
        boxMaterial.ambientTexture = new BABYLON.DynamicTexture("dynamic", textCanvas, scene, true);
        boxMaterial.diffuseColor = new BABYLON.Color3.Yeow();
        box.material = boxMaterial;
    /*
        //the context of the canvas
        var context = textCanvas.getContext("2d");

        //standard is black => mesh is black, need to be recoulered
        context.fillStyle = "white";
        context.fillRect(0, 0, textCanvas.width, textCanvas.height);

        //the black is used for the text
        context.fillStyle = "black";
        context.font = "50px serif";

        //writes the text on the canvas
        context.fillText("D210", 330, 220);

        box.material.ambientTexture.update();
    */

    /*var groundWidth =20;
    var groundHeight = 20;

    var ground = BABYLON.MeshBuilder.CreateGround("ground1", {width: groundWidth, height: groundHeight, subdivisions: 25}, scene);

    //Create dynamic texture
    var textureResolution = 512;
    var textureGround = new BABYLON.DynamicTexture("dynamic texture", {width:512, height:256}, scene);
    var textureContext = textureGround.getContext();

    var materialGround = new BABYLON.StandardMaterial("Mat", scene);
    materialGround.diffuseTexture = textureGround;
    ground.material = materialGround;

    //Add text to dynamic texture
    var font = "bold 44px monospace";
    textureGround.drawText("Grass", 75, 135, font, "green", "white", true, true);*/

    engine.runRenderLoop(function () { //runRenderLoop method -> executing renderLoopfunction(render indefinitly until told to stop)
        scene.render();
    });


});


