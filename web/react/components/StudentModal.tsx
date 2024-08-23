import React, { useState, ChangeEvent, useEffect } from "react";
import { useStudent } from "@/context/student/StudentContext";

export interface StudentForm {
  SID: number;
  FirstName: string;
  LastName: string;
  DOB: string;
  Gender: string;
}

interface StudentModalProps {
  mode: "add" | "edit" | "view";
  studentData?: StudentForm; // Used for edit or view modes
  onClose: () => void;
}

const StudentModal: React.FC<StudentModalProps> = ({ mode, studentData, onClose }) => {
  const { addStudent, updateStudent } = useStudent();
  const [student, setStudent] = useState<any>({
    FirstName: "",
    LastName: "",
    DOB: "",
    Gender: "",
  });

  // If editing or viewing, populate the form with the existing student data
  useEffect(() => {
    if (studentData && (mode === "edit" || mode === "view")) {
      setStudent(studentData);
    }
  }, [studentData, mode]);

  const onChange = (e: ChangeEvent<HTMLInputElement | HTMLSelectElement>) => {
    setStudent({ ...student, [e.target.name]: e.target.value });
  };

  const handleClick = () => {
    if (mode === "add") {
      addStudent(student);
    } else if (mode === "edit") {
      updateStudent(student);
    }
    onClose();
  };

  return (
    <div className="modal fade" id="StudentModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div className="modal-dialog modal-lg">
        <div className="modal-content">
          <div className="modal-header">
            <h5 className="modal-title" id="exampleModalLabel">
              {mode === "add" ? "Add Student" : mode === "edit" ? "Edit Student" : "Student Details"}
            </h5>
            <button type="button" className="btn-close" data-bs-dismiss="modal" aria-label="Close" onClick={onClose}></button>
          </div>
          <div className="modal-body">
            <form>
              <div className="form-group">
                <div className="row">
                  <div className="col-md-6">
                    <label htmlFor="FirstName">First Name</label>
                    <input
                      type="text"
                      className="form-control"
                      id="FirstName"
                      name="FirstName"
                      value={student.FirstName}
                      onChange={onChange}
                      placeholder="Enter First Name"
                      disabled={mode === "view"}
                    />
                  </div>
                  <div className="col-md-6">
                    <label htmlFor="LastName">Last Name</label>
                    <input
                      type="text"
                      className="form-control"
                      id="LastName"
                      name="LastName"
                      value={student.LastName}
                      onChange={onChange}
                      placeholder="Enter Last Name"
                      disabled={mode === "view"}
                    />
                  </div>
                </div>
              </div>
              <div className="row">
                <div className="col-md-6">
                  <div className="form-group">
                    <label htmlFor="DOB">DOB</label>
                    <input
                      type="date"
                      className="form-control"
                      id="DOB"
                      name="DOB"
                      value={student.DOB}
                      onChange={onChange}
                      disabled={mode === "view"}
                    />
                  </div>
                </div>
                <div className="col-md-6">
                  <div className="form-group">
                    <label htmlFor="Gender">Gender</label>
                    <select
                      className="form-control"
                      id="Gender"
                      name="Gender"
                      value={student.Gender}
                      onChange={onChange}
                      disabled={mode === "view"}
                    >
                      <option value="">Choose...</option>
                      <option value="M">Male</option>
                      <option value="F">Female</option>
                    </select>
                  </div>
                </div>
              </div>
            </form>
          </div>
          <div className="modal-footer">
            <button type="button" className="btn btn-secondary" data-bs-dismiss="modal" onClick={onClose}>
              Close
            </button>
            {mode !== "view" && (
              <button type="button" className="btn btn-primary" onClick={handleClick}>
                Save changes
              </button>
            )}
          </div>
        </div>
      </div>
    </div>
  );
};

export default StudentModal;
