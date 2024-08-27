class ConexionDB {
    private static $conexion;

    public static function abrirConexion() {
        self::$conexion = new mysqli('localhost', 'usuario', 'contraseña', 'Futbol');
        if (self::$conexion->connect_error) {
            die('Error de conexión (' . self::$conexion->connect_errno . ') ' . self::$conexion->connect_error);
        }
        return self::$conexion;
    }

    public static function cerrarConexion() {
        if (self::$conexion != null) {
            self::$conexion->close();
        }
    }

    public static function GetFutbolistasActivos() {
        $conexion = self::abrirConexion();
        $sql = "CALL SP_GET_FutbolistasACTIVE()";
        $resultado = $conexion->query($sql);

        $futbolistas = array();
        while ($fila = $resultado->fetch_assoc()) {
            $futbolista = new Futbolista();
            $futbolista->id = $fila['ID'];
            $futbolista->nombre = $fila['Nombre'];
            $futbolista->apellido = $fila['Apellido'];
            $futbolista->numero_camisa = $fila['Numero_Camisa'];
            $futbolista->fecha_nacimiento = $fila['Fecha_Nacimiento'];
            $futbolista->fecha_retiro = $fila['Fecha_Retiro'];
            $futbolista->estado = $fila['Estado'];
            $futbolistas[] = $futbolista;
        }

        self::cerrarConexion();
        return $futbolistas;
    }

    public static function GetFutbolista($id) {
        $conexion = self::abrirConexion();
        $stmt = $conexion->prepare("CALL SP_GET_Futbolistas(?)");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $resultado = $stmt->get_result();

        $futbolista = null;
        if ($fila = $resultado->fetch_assoc()) {
            $futbolista = new Futbolista();
            $futbolista->id = $fila['ID'];
            $futbolista->nombre = $fila['Nombre'];
            $futbolista->apellido = $fila['Apellido'];
            $futbolista->numero_camisa = $fila['Numero_Camisa'];
            $futbolista->fecha_nacimiento = $fila['Fecha_Nacimiento'];
            $futbolista->fecha_retiro = $fila['Fecha_Retiro'];
            $futbolista->estado = $fila['Estado'];
        }

        self::cerrarConexion();
        return $futbolista;
    }

    public static function PostFutbolista($futbolista) {
        $conexion = self::abrirConexion();
        $stmt = $conexion->prepare("CALL SP_INS_Futbolistas(?, ?, ?, ?, ?)");
        $stmt->bind_param("ssiss",
            $futbolista->nombre,
            $futbolista->apellido,
            $futbolista->numero_camisa,
            $futbolista->fecha_nacimiento,
            $futbolista->fecha_retiro
        );
        $stmt->execute();

        self::cerrarConexion();
    }

    public static function PutFutbolista($id, $futbolista) {
        $conexion = self::abrirConexion();
        $stmt = $conexion->prepare("CALL SP_UPD_Futbolistas(?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ississ",
            $id,
            $futbolista->nombre,
            $futbolista->apellido,
            $futbolista->numero_camisa,
            $futbolista->fecha_nacimiento,
            $futbolista->fecha_retiro
        );
        $stmt->execute();

        self::cerrarConexion();
    }

    public static function DeleteFutbolista($id) {
        $conexion = self::abrirConexion();
        $stmt = $conexion->prepare("CALL SP_DEL_Futbolistas(?)");
        $stmt->bind_param("i", $id);
        $stmt->execute();

        self::cerrarConexion();
    }

    public static function GetHistoricoEquipo($id) {
        $conexion = self::abrirConexion();
        $stmt = $conexion->prepare("CALL SP_GET_HISTORICOFUTBOLISTAS(?)");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $resultado = $stmt->get_result();

        $historico = array();
        while ($fila = $resultado->fetch_assoc()) {
            $objeto = new HistoricoEquipo();
            $objeto->nombre = $fila['Nombre'];
            $objeto->apellido = $fila['Apellido'];
            $objeto->nombreequipo = $fila['NombreEquipo'];
            $objeto->fecha_inicio = $fila['Fecha_Inicio'];
            $objeto->fecha_fin = $fila['Fecha_Fin'];
            $historico[] = $objeto;
        }

        self::cerrarConexion();
        return $historico;
    }

}

