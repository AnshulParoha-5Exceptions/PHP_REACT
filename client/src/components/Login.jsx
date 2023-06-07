import React, { useState } from 'react';
import axios from 'axios';

const Login = ({ handleLogin }) => {
  const [inputValue, setInputValue] = useState({
    email: '',
    password: '',
  });

  const handleSubmit = async (e) => {
    e.preventDefault();

    try {
      const response = await axios.get(
        'http://localhost/projects/PHP_REACT/backend/v1/show.php'
      );
      if (response.data.status === 'success') {
        const users = response.data.data;
        const { email, password } = inputValue; // Destructure email and password from inputValue

        let authenticatedUser = null;

        // Iterate over the users array to find a matching user
        users.forEach((user) => {
          if (user.email === email && user.password === password) {
            authenticatedUser = user;
          }
        });

        if (authenticatedUser) {
          alert("Logged In Succesfully..")
          // Call the handleLogin function passing the authenticated user
          handleLogin(authenticatedUser); // Adjust the arguments as per your requirements
        } else {
          console.log('Invalid email or password');
        }
      } else {
        console.log('Something went wrong');
      }
    } catch (error) {
      console.error(error);
    }
  };

  const handleChange = (e) => {
    const { name, value } = e.target;
    setInputValue((prevData) => ({ ...prevData, [name]: value }));
  };

  return (
    <div className='row'>
      <div className='col-md-4'></div>
      <div className='col-md-4 mt-3'>
        <h1>Login</h1>
        <form onSubmit={handleSubmit}>
          <div className='form-outline'>
            <label className='form-label'>Email</label>
            <input
              className='form-control'
              type='email'
              name='email'
              value={inputValue.email}
              onChange={handleChange}
            />
          </div>

          <div className='form-outline'>
            <label className='form-label'>Password</label>
            <input
              className='form-control'
              type='password'
              name='password'
              value={inputValue.password}
              onChange={handleChange}
            />
          </div>

          <div className='d-grid gap-2 mt-3'>
            <button className='btn btn-primary' type='submit'>
              Login
            </button>
          </div>
        </form>
      </div>
      <div className='col-md-4'></div>
    </div>
  );
};

export default Login;
