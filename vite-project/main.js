import './style.css'
import * as THREE from 'three'
import { STLLoader } from 'three/examples/jsm/loaders/STLLoader';
import { OrbitControls } from 'three/examples/jsm/controls/OrbitControls'

const scene = new THREE.Scene()
const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000)
const renderer = new THREE.WebGLRenderer({
  canvas: document.querySelector('#bg')
})
const loader = new STLLoader()
const light2 = new THREE.AmbientLight(0xffffff, 10)
light2.position.set(0, 25, 5)
scene.add(light2)
const light = new THREE.SpotLight(0xffffff)
light.position.set(0, 10, 15)
scene.add(light)
const lightHelper = new THREE.PointLightHelper(light2)
scene.add(lightHelper)
const material = new THREE.MeshPhysicalMaterial({
  color: 0xF9021C,
  metalness: 0.9,
  roughness: 1,
  opacity: 1.0,
  transparent: false,
  transmission: 0.9,
  reflectivity: 0.9,
})
const wireframeMaterial = new THREE.MeshPhysicalMaterial({
  color: 0x000000,
  wireframe: true,
  wireframeLinewidth: 1
})

let mesh = new THREE.Mesh()
let wireframeMesh = new THREE.Mesh()


renderer.setPixelRatio(window.devicePixelRatio)
renderer.setSize(window.innerWidth, window.innerHeight)
camera.position.setZ(30)

renderer.render(scene, camera)

loader.load('./skyrim_plaque.stl', function(gltf) {
  mesh = new THREE.Mesh(gltf, material)
  mesh.scale.set(-0.2, -0.2, -0.2)
  wireframeMesh = new THREE.Mesh(gltf, wireframeMaterial)
  wireframeMesh.scale.set((mesh.scale.x - 0.0020), (mesh.scale.y - 0.0020), (mesh.scale.z - 0.0020))
  scene.add(mesh, wireframeMesh)
}, undefined, function (error) {
  console.error(error)
})

const controls = new OrbitControls(camera, renderer.domElement)

function animate() {
  requestAnimationFrame(animate)
  mesh.rotation.y += 0.005
  wireframeMesh.rotation.y += 0.005
  controls.update()
  renderer.render(scene, camera)
}

animate()
