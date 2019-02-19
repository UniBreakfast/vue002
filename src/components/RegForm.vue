<template>
  <form class="regForm">
    <label for=loginInp>Логин:</label>
    <input id=loginInp v-model="data.login">
    <label for=mailInp>Электронная почта:</label>
    <input type=email id=mailInp v-model="data.mail">
    <label for=passInp>Пароль:</label>
    <input type=password id=passInp v-model="data.pass">
    <button type="button" @click="onSubmit()" id=regBtn>ЗАПИСАТЬСЯ</button>
  </form>
</template>

<script>
import axios from 'axios'

export default {
  name: 'RegForm',
  data () {
    return {
      msg: "I'm not sure...",
      data: {
        login: '',
        mail: '',
        pass: ''
      }
    }
  },
  methods: {
    onSubmit() {
      axios.post('http://localhost/vueBack/reg.php', this.data
      )
        .then(function (response) {
          // handle success
          console.log(response);
        })
        .catch(function (error) {
          // handle error
          console.log(error);
        });
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
form {
  margin: auto;
  background: cornsilk;
}
</style>
