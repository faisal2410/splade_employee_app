<x-admin-layout>
    <h1 class="text-2xl font-semibold p-4">Edit Role</h1>
   <x-splade-form :default="$role"  :action="route('admin.roles.update',$role)"  class="p-4 bg-white rounded-md space-y-2">
    <x-splade-input name="name" label="Name" />
     <x-splade-select name="permissions[]" :options="$permissions" multiple relation />
</x-admin-layout>
