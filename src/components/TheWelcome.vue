<!-- <script setup>
import WelcomeItem from './WelcomeItem.vue'
import DocumentationIcon from './icons/IconDocumentation.vue'
import ToolingIcon from './icons/IconTooling.vue'
import EcosystemIcon from './icons/IconEcosystem.vue'
import CommunityIcon from './icons/IconCommunity.vue'
import SupportIcon from './icons/IconSupport.vue'
</script>

<template>
  <WelcomeItem>
    <template #icon>
      <DocumentationIcon />
    </template>
    <template #heading>Documentation</template>

    Vue’s
    <a href="https://vuejs.org/" target="_blank" rel="noopener">official documentation</a>
    provides you with all information you need to get started.
  </WelcomeItem>

  <WelcomeItem>
    <template #icon>
      <ToolingIcon />
    </template>
    <template #heading>Tooling</template>

    This project is served and bundled with
    <a href="https://vitejs.dev/guide/features.html" target="_blank" rel="noopener">Vite</a>. The
    recommended IDE setup is
    <a href="https://code.visualstudio.com/" target="_blank" rel="noopener">VSCode</a> +
    <a href="https://github.com/johnsoncodehk/volar" target="_blank" rel="noopener">Volar</a>. If
    you need to test your components and web pages, check out
    <a href="https://www.cypress.io/" target="_blank" rel="noopener">Cypress</a> and
    <a href="https://on.cypress.io/component" target="_blank" rel="noopener"
      >Cypress Component Testing</a
    >.

    <br />

    More instructions are available in <code>README.md</code>.
  </WelcomeItem>

  <WelcomeItem>
    <template #icon>
      <EcosystemIcon />
    </template>
    <template #heading>Ecosystem</template>

    Get official tools and libraries for your project:
    <a href="https://pinia.vuejs.org/" target="_blank" rel="noopener">Pinia</a>,
    <a href="https://router.vuejs.org/" target="_blank" rel="noopener">Vue Router</a>,
    <a href="https://test-utils.vuejs.org/" target="_blank" rel="noopener">Vue Test Utils</a>, and
    <a href="https://github.com/vuejs/devtools" target="_blank" rel="noopener">Vue Dev Tools</a>. If
    you need more resources, we suggest paying
    <a href="https://github.com/vuejs/awesome-vue" target="_blank" rel="noopener">Awesome Vue</a>
    a visit.
  </WelcomeItem>

  <WelcomeItem>
    <template #icon>
      <CommunityIcon />
    </template>
    <template #heading>Community</template>

    Got stuck? Ask your question on
    <a href="https://chat.vuejs.org" target="_blank" rel="noopener">Vue Land</a>, our official
    Discord server, or
    <a href="https://stackoverflow.com/questions/tagged/vue.js" target="_blank" rel="noopener"
      >StackOverflow</a
    >. You should also subscribe to
    <a href="https://news.vuejs.org" target="_blank" rel="noopener">our mailing list</a> and follow
    the official
    <a href="https://twitter.com/vuejs" target="_blank" rel="noopener">@vuejs</a>
    twitter account for latest news in the Vue world.
  </WelcomeItem>

  <WelcomeItem>
    <template #icon>
      <SupportIcon />
    </template>
    <template #heading>Support Vue</template>

    As an independent project, Vue relies on community backing for its sustainability. You can help
    us by
    <a href="https://vuejs.org/sponsor/" target="_blank" rel="noopener">becoming a sponsor</a>.
  </WelcomeItem>
</template> -->


  <template>
  <div class="wrapper-page">
    <div class="card">
      <div class="card-body">
        <div class="p-3">
        </div>
        <div class="p-3">
          <form class="form-horizontal m-t-10" @submit.prevent="onSubmit">
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
          // Handle successful login
          console.log("Login successful", response.data);
          this.$router.push({ name: 'WelcomeItem' });
        })
        .catch(error => {
          // Handle login error
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


