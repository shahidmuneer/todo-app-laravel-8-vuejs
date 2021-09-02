<template>	
	<div>
		<h3 class="text-center my-4">Create a new list</h3>
		<form v-on:submit.prevent="createLists">
			<div class="form-group">
				<label for="name">list Name</label>
				<input type="text" class="form-control" v-bind:class="{'is-invalid': errors.name.length}" v-model="list.name" id="name" placeholder="Enter list Name">
				<div class="invalid-feedback" v-for="(error,key) in errors.name" :key="key">{{error}}</div>
			</div>
			<div class="form-group">
				<label for="description">list Description</label>
				<textarea class="form-control" id="description" v-bind:class="{'is-invalid': errors.description.length}" v-model="list.description" placeholder="Enter Description"></textarea>
				<div class="invalid-feedback" v-for="(error,key) in errors.description" :key="key">{{error}}</div>
			</div>
			<button type="submit" class="btn btn-outline-primary">Create list</button>
		</form>
	</div>
</template>

<script>
	export default {
		data() {
			return {
				list: {
					name: '',
					description: ''
				},

				//validation errors
				errors: {
					name: [],
					description: []
				},

				msg: ''
			}
		},
		methods: {
			createLists(){
				axios
					.post('/api/list',{
						name: this.list.name,
						description: this.list.description
					})
					.then(res => {
						// console.log(res)
						if(res.status == 201){
							this.flashSuccess(res.data.msg)
							this.$router.push('/lists')
						}
					})
					.catch(err => {
						console.log(err.response)
						if(err.response.status == 422){
							const errors = err.response.data.errors
							this.errors.name = errors.name || []
							this.errors.description = errors.description || []
						}
					})
			}
		}
	}
</script>