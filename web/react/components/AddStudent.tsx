import React,{useContext, useState} from "react";
import StudentContext from "@/context/student/StudentContext";

const AddStudent = () => {
  const studentContext =useContext(StudentContext);
  const {addStudent} = studentContext;
    const[student,setStudent]=useState({FirstName:"",LastName:"",DOB:"",Gender:""});
    const handleClick = ()=>{
      addStudent(student);
    }
    const onChange = (e)=>{
        setStudent({...student,[e.target.name]:e.target.value})
    }
  return (
    <div className="container">
      <div className="modal fade" id="AddModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div className="modal-dialog modal-lg">
    <div className="modal-content">
      <div className="modal-header">
        <h5 className="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" className="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div className="modal-body">
              <form>
                <div className="form-group">
                  <div className="row">
                    <div className="col-md-6">
                      <label htmlFor="FirstName">First Name</label>
                      <input type="text" className="form-control" id="FirstName" name="FirstName" onChange={onChange} aria-describedby="fnameHelp" placeholder="Enter First Name" />
                    </div>
                    <div className="col-md-6">
                      <label htmlFor="LastName">Last Name</label>
                      <input type="text" className="form-control" id="LastName" name="LastName" onChange={onChange} aria-describedby="lnameHelp" placeholder="Enter Last Name" />
                    </div>
                  </div>
                </div>
                <div className="row">
                  <div className="col-md-6">
                    <div className="form-group">
                      <label htmlFor="dob">DOB</label>
                      <input type="date" className="form-control" id="DOB" name="DOB" onChange={onChange} />
                    </div>
                  </div>
                  <div className="col-md-6">
                    <div className="form-group">
                      <label htmlFor="gender">Gender</label>
                      <select className="form-control" id="Gender" name="Gender" onChange={onChange}>
                        <option defaultValue={""}>Choose...</option>
                        <option value="M">Male</option>
                        <option value="F">Female</option>
                      </select>
                    </div>
                  </div>
                </div>
              </form>
              </div>
              <div className="modal-footer">
                <button type="button" className="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" className="btn btn-primary" onClick={handleClick}>Save changes</button>
              </div>
            </div>
          </div>
        </div>
    </div>
  );
};

export default AddStudent;
