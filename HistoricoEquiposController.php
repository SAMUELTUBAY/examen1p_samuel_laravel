require_once 'ConexionDB.php';
require_once 'HistoricoEquipo.php';

class HistoricoEquiposController {

    // GET: /api/historicoequipos/{id}
    public function getHistoricoEquipo($id) {
        return ConexionDB::GetHistoricoEquipo($id);
    }
}

$controller = new HistoricoEquiposController();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $historico = $controller->getHistoricoEquipo($id);
        echo json_encode($historico);
    }
}