<template>
  <section id=mainSct>
    <header>
      <h2 id=logo>USERpages</h2>
      <h2>Гостевая</h2>
    </header>
    <h1>Здравствуй, дорогой гость</h1>
    <section>

    </section>
  </section>
</template>

<script>
export default {
  name: 'GuestPage',
  data () {
    return {
      msg: "I'm not sure...",
      data: {
        login: ''
      }
    }
  },
  methods: {
    onSubmit() {
      //axios request goes here
      console.log(this.data);
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
#mainSct {
  background: cornsilk;
}
</style>
