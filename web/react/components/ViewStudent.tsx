import React, { useState } from "react";
import StudentModal from "@/components/StudentModal";
import {StudentForm} from "./StudentModal";


interface ViewStudentProps {
  student: StudentForm;
}

const ViewStudent: React.FC<ViewStudentProps> = ({ student }) => {
  const [showModal, setShowModal] = useState(false);

  return (
    <>
      <button type="button" className="btn btn-info" onClick={() => setShowModal(true)}>
        View
      </button>
      {showModal && (
        <StudentModal
          mode="view"
          studentData={student}
          onClose={() => setShowModal(false)}
        />
      )}
    </>
  );
};

export default ViewStudent;
