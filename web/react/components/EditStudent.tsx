import React, { useState } from "react";
import StudentModal from "@/components/StudentModal";
import {StudentForm} from "./StudentModal";

interface EditStudentProps {
  student: StudentForm;
}

const EditStudent: React.FC<EditStudentProps> = ({ student }) => {
  const [showModal, setShowModal] = useState(false);

  return (
    <>
      <button type="button" className="btn btn-secondary" onClick={() => setShowModal(true)}>
        Edit
      </button>
      {showModal && (
        <StudentModal
          mode="edit"
          studentData={student}
          onClose={() => setShowModal(false)}
        />
      )}
    </>
  );
};

export default EditStudent;
