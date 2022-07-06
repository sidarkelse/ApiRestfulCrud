<?php

namespace App\Http\Controllers;

use App\Models\Student;
use function PHPUnit\Framework\isNull;
use Illuminate\Http\Request;
use NunoMaduro\Collision\Adapters\Phpunit\Style;

class ApiController extends Controller
{
    public function AllStudent()
    {
        //obtendo  todos dados dos estudantes

        $students = Student::get()->toJson(JSON_PRETTY_PRINT);
        return response($students, 200);

    }
    public function createStudent(Request $request)
    {
        //criar registro de estudantes
        $student = new Student;
        $student->name = $request->name;
        $student->course = $request->course;
        $student->save();

        return response()->json([
            "message" => "Registro de estudante criado",
        ], 201);

    }
    public function getStudents($id)
    {
        //obter Registro de estudantes puxando  o id
        if (Student::where('id', $id)->exists()) {
            $student = Student::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($student, 200);
        } else {
            return response()->json([
                "message" => "não existe nenhum estudante",
            ], 401);
        }

    }
    public function updateStudent(Request $request, $id)
    {
        //EDITAR / atualizar Pelo Id EStudante
        if (Student::where('id', $id)->exists()) {
            $student = Student::find($id);
            $student->name = is_null($request->name) ? $student->name : $request->name;
            $student->course = is_null($request->course) ? $student->course : $request->course;
            $student->save();

            return response()->json([
                "message" => "registrado com sucesso",
            ], 200);
        } else {
            return response()->json([
                "message" => "Estudante não encontrado",
            ], 404);
        }

    }

    public function deleteStudent($id)
    {
        //Deletar registro de estudantes
        if(Student::where('id',$id)->exists())
        {
            $student = Student::find($id);
            $student->delete();
             
            return response()->json([
                "message" => "registro deletado"
             ],202);

        }else{
            return response()->json([
                "message" => "Estudante não encontrado"
            ], 404);
        }
        
    }
}
