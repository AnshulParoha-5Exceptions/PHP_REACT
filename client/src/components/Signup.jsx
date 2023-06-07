//signup.jsx
import React, { useState } from "react";
import axios from "axios";

const Signup = ({ handleLogin }) => {
  const [formData, setFormData] = useState({
    name: "",
    email: "",
    contact: "",
    address: "",
    password: "",
    repassword: "",
  });

  const handleSignup = async (e) => {
    e.preventDefault();

    const passwordRegex = /^(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_+\-=[\]{};':"\\|,.<>/?])[A-Za-z\d!@#$%^&*()_+\-=[\]{};':"\\|,.<>/?]{6,}$/;
    if (formData.password !== formData.repassword) {
      alert("Password does not match.");
    } else if (!passwordRegex.test(formData.password)) {
      alert(
        "Password must be at least 6 characters long and contain at least one uppercase letter, one lowercase letter, and one number."
      );
    } else {
      console.log(formData); // Verify that the form data is correctly populated
      try {
        const response = await axios.post(
          "http://localhost/projects/PHP_REACT/backend/v1/create.php",
          formData          
        );
        handleLogin(response.data.data)
        alert("signed up successfully..")
      } catch (error) {
        // Handle error during the request
        console.error(error);
      }
    }
  };

  const handleChange = (e) => {
    const { name, value } = e.target;
    setFormData((prevData) => ({ ...prevData, [name]: value }));
  };

  return (
    <div className="row">
      <div className="col-md-4"></div>
      <div className="col-md-4 mt-3">
        <h1>Signup</h1>
        <form onSubmit={handleSignup}>
        <div className="form-outline">
            <label className="form-label">Name</label>
            <input
              className="form-control"
              type="text"
              name="name"
              value={formData.name}
              onChange={handleChange}
            />
          </div>
          <div className="form-outline">
            <label className="form-label">Email</label>
            <input
              className="form-control"
              type="email"
              name="email"
              value={formData.email}
              onChange={handleChange}
            />
          </div>
          <div className="form-outline">
            <label className="form-label">Contact</label>
            <input
              className="form-control"
              type="tel"
              placeholder="+91"
              minLength={10}
              maxLength={10}
              name="contact"
              value={formData.contact}
              onChange={handleChange}
            />
          </div>
          <div className="form-outline">
            <label className="form-label">Address</label>
            <input
              className="form-control"
              type="text"
              name="address"
              value={formData.address}
              onChange={handleChange}
            />
          </div>
          <div className="form-outline">
            <label className="form-label">Password</label>
            <input
              className="form-control"
              type="password"
              name="password"
              value={formData.password}
              onChange={handleChange}
            />
          </div>
          <div className="form-outline">
            <label className="form-label">Re-enter Password</label>
            <input
              className="form-control"
              type="password"
              name="repassword"
              value={formData.repassword}


              
              onChange={handleChange}
            />
          </div>
          <div className="d-grid gap-2 mt-3">
            <button className="btn btn-primary" type="submit">
              Signup
            </button>
          </div>
        </form>
      </div>
      <div className="col-md-4"></div>
    </div>
  );
};

export default Signup;
