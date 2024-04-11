
  <template>
  <div class="wrapper-page">
    <div class="card">
      <div class="card-body">
        <div class="p-3">
        </div>
        <div class="p-3">
          <form class="form-horizontal m-t-10" action="/WelcomeItem" @submit.prevent="onSubmit">
            <div class="form-group">
              <label for="email">Email<span class="required ml-1">*</span></label>
              <input type="email" v-model="form.email" class="form-control" id="email" placeholder="Enter Email" autofocus>
            </div>
            <div class="form-group">
              <label for="password">Password<span class="required ml-1">*</span></label>
              <input type="password" v-model="form.password" class="form-control" id="password" placeholder="Enter Password">
            </div>
            <button class="btn btn-primary custom-btn w-md waves-effect waves-light" type="submit" :disabled="isDisabled">{{ button.text }}</button>

            <div v-if="error" class="text-danger mt-2">{{ error }}</div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import router from '@/routes';

export default {
  data() {
    return {
      button: { text: "Sign In" },
      form: {
        email: "",
        password: ""
      },
      isLoading: false,
      error: null
    };
  },
  methods: {
    onSubmit() {
      this.isLoading = true;
      this.error = null;
      axios.post('http://127.0.0.1:8000/api/login', this.form)
        .then(response => {
         
          console.log("Login successful", response.data);
        
          this.$router.push({ path: "/WelcomeItem" });
       
        })
        .catch(error => {
        
          console.error("Login failed", error.response.data);
          this.error = error.response.data.message || "An error occurred during login.";
        })
        .finally(() => {
          this.isLoading = false;
        });
    }
  },
  computed: {
    isDisabled() {
      return this.isLoading || !this.form.email || !this.form.password;
    }
  }
};
</script>

<style scoped>
.wrapper-page {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
}

.card {
  width: 400px;
}

.form-group {
  margin-bottom: 20px;
}

.form-control {
  width: 100%;
  padding: 10px;
  font-size: 16px;
  border: 1px solid #ccc;
  border-radius: 5px;
}

.btn-primary {
  width: 100%;
  padding: 10px;
  font-size: 16px;
  border-radius: 5px;
}

.text-danger {
  margin-top: 5px;
  font-size: 14px;
}

.custom-btn {
  background-color: #007bff; /* Blue color */
  color: #fff; /* White text color */
}

.custom-btn:hover {
  background-color: #0056b3; /* Darker blue color on hover */
}
</style>


