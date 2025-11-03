<?php
    require_once("./Model/M_Student.php");

    class C_Student {
        private $model;

        public function __construct()
        {
            $this -> model = new M_Student();
        }

        public function invoke(){
            if(!isset($_GET['action'])) {
                $students = $this -> model -> getAllStudents();
                include("./View/StudentList.php");
            } else {
               switch($_GET['action']) {
                    case "view":
                        if(isset($_GET['ID'])) {
                            $student = $this -> model -> getStudentByID($_GET['ID']);
                            if($student) {
                                include("./View/StudentDetail.php");
                            } else {
                                echo "Student not found.";
                            }
                        } else {
                            echo "No student ID provIDed.";
                        }
                        break;
                    case "add":
                        if($_SERVER['REQUEST_METHOD'] === 'POST') {
                            $newStudent = new Student(
                                $_POST['ID'],
                                $_POST['NAME'],
                                $_POST['AGE'],
                                $_POST['UNIVERSITY']
                            );
                            $this -> model -> addStudent($newStudent);
                            header("Location: ./index.php");
                        } else {
                            include("./View/AddStudent.php");
                        }
                        break;
                    case "update":
                        if(isset($_GET['ID'])) {
                            $student = $this -> model -> getStudentByID($_GET['ID']);
                            if(!$student) {
                                echo "Student not found.";
                                break;
                            }
                            if($_SERVER['REQUEST_METHOD'] === 'POST') {
                                $student->NAME = $_POST['NAME'];
                                $student->AGE = $_POST['AGE'];
                                $student->UNIVERSITY = $_POST['UNIVERSITY'];
                                $this -> model -> updateStudent($student);
                                header("Location: ./index.php");
                            } else {
                                include("./View/UpdateStudent.php");
                            }
                        } else {
                            echo "No student ID provIDed.";
                        }
                        break;
                    case "delete":
                        if(isset($_GET['ID'])) {
                            $this -> model -> deleteStudent($_GET['ID']);
                            header("Location: ./index.php");
                        } else {
                            echo "No student ID provIDed.";
                        }
                    case "delete-multiple":
                        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['selected_ids'])) {
                            foreach ($_POST['selected_ids'] as $id) {
                                $this->model->deleteStudent($id);
                            }
                            header("Location: index.php");
                            exit();
                        } else {
                            echo "Không có sinh viên nào được chọn để xóa.";
                        }
                        break;
                    // case "search":
                    //     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    //         $id = $_POST['ID'] ?? null;
                    //         $name = $_POST['NAME'] ?? null;
                    //         $university = $_POST['UNIVERSITY'] ?? null;

                    //         $students = $this->model->searchStudents($id, $name, $university);
                    //         include("./View/SearchResult.php");
                    //     } else {
                    //         include("./View/SearchForm.php");
                    //     }
                    //     break;

                    default:
                        echo "InvalID action.";
                        break;
                }
            }
        }

        public function invokeSearch() {
            $id = $_POST['ID'] ?? null;
            $name = $_POST['NAME'] ?? null;
            $university = $_POST['UNIVERSITY'] ?? null;

            $students = $this->model->searchStudents($id, $name, $university);
            include("./View/StudentList.php"); // dùng lại view danh sách
        }
    }
?>
