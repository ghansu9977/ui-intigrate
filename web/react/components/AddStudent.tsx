import React, { useState } from "react";
import StudentModal from "@/components/StudentModal";

const AddStudent: React.FC = () => {
  const [showModal, setShowModal] = useState(false);

  return (
    <>
      <button type="button" className="btn btn-primary" onClick={() => setShowModal(true)}>
        Add Student
      </button>
      {showModal && <StudentModal mode="add" onClose={() => setShowModal(false)} />}
    </>
  );
};

export default AddStudent;
