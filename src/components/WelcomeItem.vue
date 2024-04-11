<template>
  <div class="form-container">
    <form @submit.prevent="submitForm">
      <div>
        <label for="firstname">First Name:</label>
        <input type="text" id="firstname" v-model="form.firstname" required>
      </div>
      <div>
        <label for="lastname">Last Name:</label>
        <input type="text" id="lastname" v-model="form.lastname" required>
      </div>
      <div>
        <label for="date_of_birth">Date of Birth:</label>
        <input type="date" id="date_of_birth" v-model="form.date_of_birth" required>
      </div>
      <div>
        <label for="email">Email:</label>
        <input type="email" id="email" v-model="form.email" required>
      </div>
      <div>
        <label for="password">Password:</label>
        <input type="password" id="password" v-model="form.password" required>
      </div>
      <div>
        <label for="phone">Phone:</label>
        <input type="tel" id="phone" v-model="form.phone" required>
      </div>
    
      <div>
        <label for="educational_qualification">Educational Qualification:</label>
        <input type="text" id="educational_qualification" v-model="form.educational_qualification">
      </div>
      <div>
        <label for="photo">Photo:</label>
        <input type="file" id="photo" accept="image/*" @change="handlePhotoUpload">
      </div>
      <div>
        <label for="resume">Resume:</label>
        <input type="file" id="resume" accept=".pdf,.doc,.docx" @change="handleResumeUpload">
      </div>
      <button type="submit">Submit</button>
    </form>
  </div>
</template>

<script>
import axios from 'axios';
export default {
  data() {
    return {
      form: {
        firstname: '',
        lastname: '',
        date_of_birth: '',
        email: '',
        password: '',
        phone: '',
      
        educational_qualification: '',
        photo: null,
        resume: null
      }
    };
  },
  methods: {
    submitForm() {
   
      axios.post('http://127.0.0.1:8000/api/register', this.form)
        .then(response => {
       
          console.log(response.data);
          
        })
        .catch(error => {
         
          console.error(error);
    
        });
    },
    handlePhotoUpload(event) {
      this.form.photo = event.target.files[0];
    },
    handleResumeUpload(event) {
      this.form.resume = event.target.files[0];
    }
  }
};
</script>

<style>
.form-container {
  max-width: 400px;
  margin: 0 auto;
  padding: 20px;
  border: 1px solid #ccc;
  border-radius: 5px;
  background-color: #f9f9f9;
}

.form-container label {
  display: block;
  margin-bottom: 5px;
}

.form-container input[type="text"],
.form-container input[type="email"],
.form-container input[type="password"],
.form-container input[type="tel"],
.form-container input[type="date"],
.form-container input[type="file"] {
  width: calc(100% - 12px);
  padding: 8px;
  margin-bottom: 10px;
  border: 1px solid #ccc;
  border-radius: 4px;
}

.form-container button {
  width: 100%;
  padding: 10px;
  margin-top: 10px;
  border: none;
  border-radius: 4px;
  background-color: #007bff;
  color: #fff;
  cursor: pointer;
}

.form-container button:hover {
  background-color: #0056b3;
}
</style>
