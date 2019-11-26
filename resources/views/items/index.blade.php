@extends('layouts.master')
@section('content')
	<div class="container" id="app">
		<table class="table">
			<thead>
				<tr>
					<th scope="col">Id</th>
					<th scope="col">Name</th>
					<th scope="col">Quantity</th>
					<th scope="col">Category</th>
					<th scope="col">Actions</th>
					<th scope="col"></th>
				</tr>
			</thead>
			<tbody>
				
					<tr v-for='item in items'>
						<td>@{{item.id }}</td>
						<td>@{{item.name }}</td>
						<td>@{{item.quantity }}</td>
						<td>@{{item.category }}</td>
						<td><a class="btn btn-primary" data-toggle="modal" data-target="#editItem">Edit</a></td>
						<td><a class="btn btn-primary" v-on:click='deleteItem(item)'>Delete</a></td>
					</tr>
			
			</tbody>
		</table>
		<a class="btn btn-primary" data-toggle="modal" data-target="#additem">Add New Item</a>
{{-- ADD MODAL  --}}
	<div class="modal" id ="additem" tabindex="-1" role="dialog">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title">Add Item</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
		 	<div class="form-group">
		    <br>
		    <p>Item Name</p>
		    <input type="text" class="form-control" v-model='new_item.name' name='name'  placeholder="Item Name">
		    <br>
		    <p>Input Quantity</p>
		    <input type="text" class="form-control" v-model='new_item.quantity' name='quantity' v-model='quantity'  placeholder="Quantity">
		    <br>
		    <select class="custom-select custom-select-lg mb-3"  v-model='new_item.category' name ="category"> 
		    	@foreach ($categories as $category)
		    	<option class="option"  value='{{ $category->name }} '>
		    		{{ $category->name }}</option>
		    	@endforeach
		    </select>
		    <br>
		  </div>
		  <button type='Submit' v-on:click="saveNewItem" class="btn btn-primary">Submit</button>
		  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	    </div>
	  </div>
	</div>
	</div>
{{-- EDIT MODAL --}}
	<div class="modal" id ="editItem" tabindex="-1" role="dialog">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title">Edit Item</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
		 	<div class="form-group">
		    <br>
		    <p>Item Name</p>
		    <input type="text" class="form-control" v-model='new_item.name' name='name'  placeholder="Item Name">
		    <br>
		    <p>Input Quantity</p>
		    <input type="text" class="form-control" v-model='new_item.quantity' name='quantity' v-model='quantity'  placeholder="Quantity">
		    <br>
		    <select class="custom-select custom-select-lg mb-3"  v-model='new_item.category' name ="category"> 
		    	@foreach ($categories as $category)
		    	<option class="option"  value='{{ $category->name }} '>
		    		{{ $category->name }}</option>
		    	@endforeach
		    </select>
		    <br>
		  </div>
		  <button type='Submit' v-on:click="editItem" class="btn btn-primary">Save</button>
		  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	    </div>
	  </div>
	</div>
	</div>	
@endsection
@section('scripts')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.18/vue.min.js"></script>
	<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
	<script>
		var items = @json($items);
	</script>
	<script type="text/javascript">
		var vm = new Vue({
			el:'#app',
			data:{
				items:items,
					new_item: {
						id: '',
						name:'',
						quantity:'',
						category:'',
				}
			},
			methods: {
				saveNewItem() {		
					axios.post('/items/store', this.new_item)
						.then(({data})=>{
							this.items.push(data);
							this.new_item.name = '';
							this.new_item.quantity = '';
							this.new_item.category = '';
							console.log(data);
						});
				},
				editItem(item) {
					axios.post('/items/'+item.id+'/update')
						.then(function(response){
								
						});


				},
				deleteItem(item) {
					axios.post('/items/'+item.id+'/delete')
						.then(function(response){
							var index = vm.items.indexOf(item);
							vm.items.splice(index, 1);
						});
				}
			}
			
		});
</script>
@endsection