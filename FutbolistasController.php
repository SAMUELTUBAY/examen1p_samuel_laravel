require_once 'ConexionDB.php';
require_once 'Futbolista.php';

class FutbolistasController {

    // GET: /api/futbolistas
    public function getFutbolistasActivos() {
        return ConexionDB::GetFutbolistasActivos();
    }

    // GET: /api/futbolistas/{id}
    public function getFutbolista($id) {
        return ConexionDB::GetFutbolista($id);
    }

    // POST: /api/futbolistas
    public function postFutbolista($data) {
        $futbolista = new Futbolista();
        $futbolista->nombre = $data['nombre'];
        $futbolista->apellido = $data['apellido'];
        $futbolista->numero_camisa = $data['numero_camisa'];
        $futbolista->fecha_nacimiento = $data['fecha_nacimiento'];
        $futbolista->fecha_retiro = $data['fecha_retiro'];
        ConexionDB::PostFutbolista($futbolista);
    }

    // PUT: /api/futbolistas/{id}
    public function putFutbolista($id, $data) {
        $futbolista = new Futbolista();
        $futbolista->nombre = $data['nombre'];
        $futbolista->apellido = $data['apellido'];
        $futbolista->numero_camisa = $data['numero_camisa'];
        $futbolista->fecha_nacimiento = $data['fecha_nacimiento'];
        $futbolista->fecha_retiro = $data['fecha_retiro'];
        ConexionDB::PutFutbolista($id, $futbolista);
    }

    // DELETE: /api/futbolistas/{id}
    public function deleteFutbolista($id) {
        ConexionDB::DeleteFutbolista($id);
    }
}

$controller = new FutbolistasController();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $futbolista = $controller->getFutbolista($id);
        echo json_encode($futbolista);
    } else {
        $futbolistas = $controller->getFutbolistasActivos();
        echo json_encode($futbolistas);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $controller->postFutbolista($data);
} elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $data = json_decode(file_get_contents('php://input'), true);
        $controller->putFutbolista($id, $data);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $controller->deleteFutbolista($id);
    }
}