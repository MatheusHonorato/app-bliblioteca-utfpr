@extends('layouts.app')

@section('title', 'Usuários')

@section('sidebar')
    @parent
@endsection

@section('content')

<div class="container">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
						<h2><b>Usuários</b></h2>
					</div>
					<div class="col-sm-6">
						<a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Adicionar</span></a>					
					</div>
				</div>
				@if (session('status'))
					<div class="alert alert-success mt-3">
						{{ session('status') }}
						<button type="button" class="close" data-dismiss="alert">×</button>
					</div>
				@endif
				@if (session('error'))
					<div class="alert alert-danger mt-3">
						{{ session('error') }}
						<button type="button" class="close" data-dismiss="alert">×</button>
					</div>
				@endif
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th class="mwidth">Nome</th>
                        <th>RA</th>
						<th>Endereço</th>
                        <th>Telefone</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
					@foreach($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->student->ra }}</td>
						<td>{{ $user->address }}</td>
                        <td>{{ $user->phones->phone }}</td>
                        <td>
                            <a href="#editEmployeeModal{{ $user->id }}" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Editar">&#xE254;</i></a>
                            <a href="#deleteEmployeeModal{{ $user->id }}" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Excluir">&#xE872;</i></a>
                        </td>
					</tr>
					<!-- Edit Modal HTML -->
					<div id="editEmployeeModal{{ $user->id }}" class="modal fade">
						<div class="modal-dialog">
							<div class="modal-content">
								<form method="POST" action="{{ route('users.update', $user->id) }}">
									@csrf
									@method('PATCH')
									<div class="modal-header">						
										<h4 class="modal-title">Editar Usuário</h4>
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									</div>
									<div class="modal-body">					
										<div class="form-group has-feedback {{ $errors->has('name') ? 'has-error' : '' }}">
											<label>Nome</label>
											<input type="text" name="name" value="{{ $user->name }}" class="form-control" required>
											@if ($errors->has('name'))
											<span class="help-block text-danger">
												<strong>{{ $errors->first('name') }}</strong>
											</span>
											@endif
										</div>
										<div class="form-group has-feedback {{ $errors->has('ra') ? 'has-error' : '' }}">
											<label>R.A.</label>
											<input type="text" name="ra" value="{{ $user->student->ra }}" class="form-control" required>
											@if ($errors->has('ra'))
											<span class="help-block text-danger">
												<strong>{{ $errors->first('ra') }}</strong>
											</span>
											@endif
										</div>
										<div class="form-group has-feedback {{ $errors->has('date') ? 'has-error' : '' }}">
											<label>Data de Nascimento</label>
											<input type="date" name="date" value="{{ $user->date }}" class="form-control" required>
											@if ($errors->has('date'))
											<span class="help-block text-danger">
												<strong>{{ $errors->first('date') }}</strong>
											</span>
											@endif
										</div>
										<div class="form-group has-feedback {{ $errors->has('address') ? 'has-error' : '' }}">
											<label>Endereço</label>
											<input type="text" name="address" value="{{ $user->address }}" class="form-control" required>
											@if ($errors->has('address'))
											<span class="help-block text-danger">
												<strong>{{ $errors->first('address') }}</strong>
											</span>
											@endif
										</div>
										<div class="form-group has-feedback {{ $errors->has('phone') ? 'has-error' : '' }}">
											<label>Telefone</label>
											<input type="text" name="phone" value="{{ $user->phones->phone }}" class="form-control" required>
											@if ($errors->has('phone'))
											<span class="help-block text-danger">
												<strong>{{ $errors->first('phone') }}</strong>
											</span>
											@endif
										</div>					
									</div>
									<div class="modal-footer">
										<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
										<input type="submit" class="btn btn-success" value="Salvar">
									</div>
								</form>
							</div>
						</div>
					</div>
					<!-- Delete Modal HTML -->
					<div id="deleteEmployeeModal{{ $user->id }}" class="modal fade">
						<div class="modal-dialog">
							<div class="modal-content">
								<form method="POST" action="{{ route('users.destroy', $user->id) }}">
									@csrf	
									@method('DELETE')
									<div class="modal-header">						
										<h4 class="modal-title">Excluir Usuário</h4>
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									</div>
									<div class="modal-body">					
										<p>Você tem certeza que deseja excluir esse registro?</p>
										<p class="text-warning"><small>Essa ação não pode ser revertida.</small></p>
									</div>
									<div class="modal-footer">
										<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
										<input type="submit" class="btn btn-danger" value="Excluir">
									</div>
								</form>
							</div>
						</div>
					</div>
					@endforeach
                </tbody>
            </table>
			<div class="clearfix">
				<div class="hint-text"><b>{{ $users->currentPage() }}</b> de <b>{{ $users->lastPage() }}</b></div>
				{{ $users->links() }}
            </div>
        </div>
    </div>
	<!-- Add Modal HTML -->
	<div id="addEmployeeModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form method="POST" action="{{ route('users.store') }}">
					@csrf
					@method('POST')
					<div class="modal-header">						
						<h4 class="modal-title">Adicionar Usuário</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">					
						<div class="form-group has-feedback {{ $errors->has('name') ? 'has-error' : '' }}">
							<label>Nome</label>
							<input type="text" name="name" class="form-control" required>
							@if ($errors->has('name'))
                            <span class="help-block text-danger">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                    		@endif
						</div>
						<div class="form-group has-feedback {{ $errors->has('ra') ? 'has-error' : '' }}">
							<label>R.A.</label>
							<input type="text" name="ra" class="form-control" required>
							@if ($errors->has('ra'))
                            <span class="help-block text-danger">
                                <strong>{{ $errors->first('ra') }}</strong>
                            </span>
                    		@endif
						</div>
						<div class="form-group has-feedback {{ $errors->has('date') ? 'has-error' : '' }}">
							<label>Data de Nascimento</label>
							<input type="date" name="date" class="form-control" required>
							@if ($errors->has('date'))
                            <span class="help-block text-danger">
                                <strong>{{ $errors->first('date') }}</strong>
                            </span>
                    		@endif
						</div>
						<div class="form-group has-feedback {{ $errors->has('address') ? 'has-error' : '' }}">
							<label>Endereço</label>
							<input type="text" name="address" class="form-control" required>
							@if ($errors->has('address'))
                            <span class="help-block text-danger">
                                <strong>{{ $errors->first('address') }}</strong>
                            </span>
                    		@endif
						</div>
						<div class="form-group has-feedback {{ $errors->has('phone') ? 'has-error' : '' }}">
							<label>Telefone</label>
							<input type="text" name="phone" class="form-control" required>
							@if ($errors->has('phone'))
                            <span class="help-block text-danger">
                                <strong>{{ $errors->first('phone') }}</strong>
                            </span>
                    		@endif
						</div>					
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
						<input type="submit" class="btn btn-success" value="Salvar">
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection