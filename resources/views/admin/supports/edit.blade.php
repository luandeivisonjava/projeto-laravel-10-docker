<h1>Duvida id: {{ $support->id }}</h1>
<x-alert/>
<form action="{{route('supports.update', $support->id)}}" method="POST">
    @csrf()
    @method('put')
    @include('admin.supports.partils.form',['support'=> $support])
</form>
