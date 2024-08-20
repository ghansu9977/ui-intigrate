import { useEffect, useState } from "react";
import axios from "axios";
interface Students {
  SID: number;
  FirstName: string;
  LastName: string;
  DOB: string;
  Gender: string;
}

const StudentsList = () => {
  const [students, setStudents] = useState<Students[]>([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState<string | null>(null);

  useEffect(() => {
    const fetchStudents = async () => {
      try {
        const responce = await axios.get<Students[]>(
          "http://localhost:8080/api/students"
        );
        setStudents(responce.data);
      } catch (error) {
        if (axios.isAxiosError(error) && error.response) {
          setError(
            `Error: ${error.response.status} ${error.response.statusText}`
          );
        } else {
          setError("An unknown error occurred");
        }
      } finally {
        setLoading(false);
      }
    };

    fetchStudents();
  }, []);

  if (loading) {
    return <div>Loading...</div>;
  }

  if (error) {
    return <div>Error: {error}</div>;
  }

  return (
    <div>
      <table className="table">
        <thead>
          <tr>
            <th scope="col">SID</th>
            <th scope="col">First Name</th>
            <th scope="col">Last Name</th>
            <th scope="col">DOB</th>
            <th scope="col">Gender</th>
          </tr>
        </thead>
        <tbody>
          {students.map((student, i) => (
            <tr key={student.SID}>
              <td>{i + 1}</td>
              <td>{student.FirstName}</td>
              <td>{student.LastName}</td>
              <td>{student.DOB}</td>
              <td>{student.Gender}</td>
            </tr>
          ))}
        </tbody>
      </table>
    </div>
  );
};

export default StudentsList;
