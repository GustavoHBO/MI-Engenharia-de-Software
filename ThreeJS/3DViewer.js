var camera, scene, renderer;
var container;
var obj;

function init(){
     //camera
    camera = new THREE.PerspectiveCamera(70, 1, 1, 2000);
    camera.position.set(0,0,50);
    //cena
    scene = new THREE.Scene();

    //renderer
    renderer = new THREE.WebGLRenderer();
    renderer.setPixelRatio(window.devicePixelRatio);
    renderer.setSize(500,500);
    renderer.setClearColor(0xb1ee97);
    var container = document.getElementById('3dview');
    container.appendChild(renderer.domElement);

    //Iluminação do ambiente
    var ambient = new THREE.AmbientLight(0x101030);
    scene.add(ambient);

    var spotlight = new THREE.SpotLight(0xffffff);
    spotlight.position.set(100,-100,100);
    spotlight.castShadow = true;
    spotlight.shadowMapWidth = 1024;
    spotlight.shadowMapHeight = 1024;
    spotlight.shadowCameraNear = 500;
    spotlight.shadowCameraFar = 4000;
    spotlight.shadowCameraFov = 30;
    scene.add(spotlight);

    //Carregando objeto
    var loader = new THREE.OBJLoader();
    loader.load('http://localhost:8000/male02.obj', function (object){
        obj = object;
        object.scale.set(0.15,0.15,0.15);
        object.position.y = -20;
        scene.add(object);
        animate();
    });

}

//Animação do objeto
function animate(){
    requestAnimationFrame(animate);
    obj.rotation.y -= 0.03;
    renderer.render(scene, camera);
}

window.onload = init;