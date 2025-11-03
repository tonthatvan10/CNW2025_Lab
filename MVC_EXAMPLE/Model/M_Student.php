<?php
    require_once("./Config/db.php");
    require_once("E_Student.php");

    class M_Student {
        private $conn;
        
        public function __construct()
        {
            $database = new Database();
            $this->conn = $database->connect();
        }

        public function getAllStudents() {
            $students = [];
            $query = "SELECT * FROM sinhvien";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($result as $row) {
                $student = new Student(
                    $row['ID'],
                    $row['NAME'],
                    $row['AGE'],
                    $row['UNIVERSITY']
                );
                $students[] = $student;
            }
            return $students;
        }

        public function getStudentByID($ID) {
            $query = "SELECT * FROM sinhvien WHERE ID = :ID";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':ID', $ID);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                return new Student(
                    $row['ID'],
                    $row['NAME'],
                    $row['AGE'],
                    $row['UNIVERSITY']
                );
            }
            return null;
        }

        public function addStudent($student) {
            $query = "INSERT INTO sinhvien (ID, NAME, AGE, UNIVERSITY) VALUES (:ID, :NAME, :AGE, :UNIVERSITY)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':ID', $student->ID);
            $stmt->bindParam(':NAME', $student->NAME);
            $stmt->bindParam(':AGE', $student->AGE);
            $stmt->bindParam(':UNIVERSITY', $student->UNIVERSITY);
            return $stmt->execute();
        }

        public function updateStudent($student) {
            $query = "UPDATE sinhvien SET NAME = :NAME, AGE = :AGE, UNIVERSITY = :UNIVERSITY WHERE ID = :ID";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':ID', $student->ID);
            $stmt->bindParam(':NAME', $student->NAME);
            $stmt->bindParam(':AGE', $student->AGE);
            $stmt->bindParam(':UNIVERSITY', $student->UNIVERSITY);
            return $stmt->execute();
        }

        public function deleteStudent($ID) {
            $query = "DELETE FROM sinhvien WHERE ID = :ID";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':ID', $ID);
            return $stmt->execute();
        }

        public function searchStudents($ID = null, $NAME = null, $UNIVERSITY = null) {
            $students = [];
            $query = "SELECT * FROM sinhvien WHERE 1=1"; // điều kiện mặc định luôn đúng

            if (!empty($ID)) {
                $query .= " AND ID = :ID";
            }
            if (!empty($NAME)) {
                $query .= " AND NAME LIKE :NAME";
            }
            if (!empty($UNIVERSITY)) {
                $query .= " AND UNIVERSITY LIKE :UNIVERSITY";
            }

            $stmt = $this->conn->prepare($query);

            if (!empty($ID)) {
                $stmt->bindParam(':ID', $ID);
            }
            if (!empty($NAME)) {
                $likeNAME = "%" . $NAME . "%";
                $stmt->bindParam(':NAME', $likeNAME);
            }
            if (!empty($UNIVERSITY)) {
                $likeUNIV = "%" . $UNIVERSITY . "%";
                $stmt->bindParam(':UNIVERSITY', $likeUNIV);
            }

            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($result as $row) {
                $student = new Student(
                    $row['ID'],
                    $row['NAME'],
                    $row['AGE'],
                    $row['UNIVERSITY']
                );
                $students[] = $student;
            }

            return $students;
        }

    }
?>