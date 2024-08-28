import React, { useState } from "react";
import StudentModal from "@/components/StudentModal";

const AddStudent: React.FC = () => {
  return (
    <>
      <button type="button" className="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addStudentModal">
        Add Student
      </button>
      <StudentModal id="addStudentModal" mode="add" />
    </>
  );
};

export default AddStudent;
