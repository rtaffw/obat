<template id="login">
  <div class="row">
   <div class="col-xs-12">
     <form v-on:submit.prevent ="login">
         <div class="form-group">
           <label for="email">Email</label>
           <input id="email" v-model="post.email" type="email" class="form-control" placeholder="Email" required >
         </div>
         <div class="form-group">
           <label for="password">Password</label>
           <input id="password" v-model="post.password" type="password" class="form-control" placeholder="Password" required >
         </div>
         <button type="submit" class="btn btn-xs btn-primary" >Login</button>
         <router-link class="btn btn-xs btn-danger" v-bind:to="'/register'">Register</router-link>
       </form>

     <br><br><br>
   </div>
  </div>
</template>

<script>
export default {
  mounted() {
      // return this.$router.push({name:'Home'});
  },
  data: function(){
  return {post : {title:'',body:''}}
  // return this.$router.push({name:'Home'});
  },
  methods : {
    login : function(){
        let uri = 'http://localhost:8000/login';
        Axios.post(uri, this.post).then((response) => {
        // this.$router.push({name:'Listposts'});
        console.log(response);
      })
    }
  }
}
</script>

<style lang="css">
</style>
