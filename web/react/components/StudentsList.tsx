import React, { useEffect, useState } from "react";
import { useStudent } from "@/context/student/StudentContext";
import StudentModal, { StudentForm } from "@/components/StudentModal";
interface Student {
  SID: number;
  FirstName: string;
  LastName: string;
  DOB: string;
  Gender: string;
}

const StudentsList: React.FC = () => {
  const [editStudent, setEditStudent] = useState<StudentForm | null>(null);
  const { getStudent,deleteStudent, students } = useStudent();
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState<string | null>(null);
  useEffect(() => {
    const fetchStudent = async () => {
      try {
        await getStudent();
      } catch {
        setError("Failed to Fetch Students");
      } finally {
        setLoading(false);
      }
    };
    fetchStudent();
  }, []);

  if (loading) return <div>Loading...</div>;
  if (error) return <div>Error: {error}</div>;

  return (
    <div className="container">
      {/* editModal */}
      {editStudent && <StudentModal id={`editStudentModal`} mode="edit" studentData={editStudent} />}
      {/* viewModal */}
      {editStudent && <StudentModal id={`viewStudentModal`} mode="view" studentData={editStudent} />}
      <div className="row justify-content-center">
        <div className="col-lg-12">
          <table className="table table-striped">
            <thead className="thead-dark">
              <tr>
                <th scope="col">S.no</th>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">DOB</th>
                <th scope="col">Gender</th>
                <th scope="col" className="text-center">Action</th>
              </tr>
            </thead>
            <tbody>
              {students.map((student, index) => (
                <tr key={student.SID}>
                  <td>{index + 1}</td>
                  <td>{student.FirstName}</td>
                  <td>{student.LastName}</td>
                  <td>{student.DOB}</td>
                  <td>{student.Gender === "M" ? "Male" : "Female"}</td>
                  <td className="text-center">
                    <button type="button" className="btn btn-info me-3" data-bs-toggle="modal" onClick={()=>setEditStudent(student)} data-bs-target={`#viewStudentModal`}>View</button>
                    <button type="button" className="btn btn-secondary me-3" data-bs-toggle="modal" onClick={()=>setEditStudent(student)} data-bs-target={`#editStudentModal`}>Edit</button>
                    <button className="btn btn-danger" onClick={()=>deleteStudent(student)}>Delete</button>
                  </td>
                </tr>
              ))}
            </tbody>
          </table>
        </div>
      </div>
    </div>
  );
};

export default StudentsList;
