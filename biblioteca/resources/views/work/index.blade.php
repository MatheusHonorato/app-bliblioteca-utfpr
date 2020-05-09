@extends('layouts.app')

@section('title', 'Obras')

@section('sidebar')
    @parent
@endsection

@section('content')
<div class="container">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
						<h2><b>Obras</b></h2>
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
                        <th scope="col" class="mwidth">Título</th>
                        <th scope="col">Ano de Publicação</th>
						<th scope="col">Tipo de Obra</th>
						<th scope="col">Autor</th>
                        <th scope="col" class="mwidth">Ações</th>
                    </tr>
                </thead>
                <tbody>
					@foreach($work as $works)
                    <tr>
                        <td>{{ $works->title }}</td>
                        <td>{{ $works->year }}</td>
						<td>{{ $works->type->name }}</td>
						<td>{{ $works->author->name }}</td>
                        <td>
							<a href="{{ route('work.show', $works->id) }}"><i class="material-icons fa fa-plus-circle" data-toggle="tooltip" title="Acessar"></i></a>
                            <a href="#editEmployeeModal{{ $works->id }}" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Editar">&#xE254;</i></a>
                            <a href="#deleteEmployeeModal{{ $works->id }}" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Excluir">&#xE872;</i></a>
                        </td>
					</tr>
					<!-- Edit Modal HTML -->
					<div id="editEmployeeModal{{ $works->id }}" class="modal fade">
						<div class="modal-dialog">
							<div class="modal-content">
								<form method="POST" action="{{ route('work.update', $works->id) }}">
									@csrf
									@method('PATCH')
									<div class="modal-header">						
										<h4 class="modal-title">Editar Obra</h4>
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									</div>
									<div class="modal-body">					
										<div class="form-group has-feedback {{ $errors->has('name') ? 'has-error' : '' }}">
											<label>Título</label>
											<input type="text" name="title" value="{{ $works->title }}" class="form-control" required>
											@if ($errors->has('title'))
											<span class="help-block text-danger">
												<strong>{{ $errors->first('title') }}</strong>
											</span>
											@endif
										</div>
										<div class="form-group has-feedback {{ $errors->has('name') ? 'has-error' : '' }}">
											<label>Ano de Publicação</label>
											<input type="text" name="year" value="{{ $works->year }}" class="form-control" required>
											@if ($errors->has('year'))
											<span class="help-block text-danger">
												<strong>{{ $errors->first('year') }}</strong>
											</span>
											@endif
										</div>
										<div class="form-group has-feedback {{ $errors->has('name') ? 'has-error' : '' }}">
											<label>Tipo de Obra</label>
											<select name="type" class="form-control" required>
											@foreach($types as $type)
												<option value="{{ $type->id }}" @if($works->type->id === $type->id) selected @endif>{{ $type->name }}</option>
											@endforeach
											</select>
											@if ($errors->has('type'))
											<span class="help-block text-danger">
												<strong>{{ $errors->first('type') }}</strong>
											</span>
											@endif
										</div>
										<div class="form-group has-feedback {{ $errors->has('name') ? 'has-error' : '' }}">
											<label>Autor</label>
											<select name="author" class="form-control" required>
												@foreach($authors as $author)
													<option value="{{ $author->id }}" @if($works->author->id === $author->id) selected @endif>{{ $author->name }}</option>
												@endforeach
											</select>
											@if ($errors->has('author'))
											<span class="help-block text-danger">
												<strong>{{ $errors->first('author') }}</strong>
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
					<div id="deleteEmployeeModal{{ $works->id }}" class="modal fade">
						<div class="modal-dialog">
							<div class="modal-content">
								<form method="POST" action="{{ route('work.destroy', $works->id) }}">
									@csrf	
									@method('DELETE')
									<div class="modal-header">						
										<h4 class="modal-title">Excluir Obra</h4>
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
				<div class="hint-text"><b>{{ $work->currentPage() }}</b> de <b>{{ $work->lastPage() }}</b></div>
				{{ $work->links() }}
            </div>
        </div>
    </div>
	<!-- Add Modal HTML -->
	<div id="addEmployeeModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form method="POST" action="{{ route('work.store') }}">
					@csrf
					@method('POST')
					<div class="modal-header">						
						<h4 class="modal-title">Adicionar Obra</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">					
						<div class="form-group has-feedback {{ $errors->has('name') ? 'has-error' : '' }}">
							<label>Título</label>
							<input type="text" name="title" class="form-control" required>
							@if ($errors->has('title'))
							<span class="help-block text-danger">
								<strong>{{ $errors->first('title') }}</strong>
							</span>
							@endif
						</div>
						<div class="form-group has-feedback {{ $errors->has('name') ? 'has-error' : '' }}">
							<label>Ano de Publicação</label>
							<input type="text" name="year" class="form-control" required>
							@if ($errors->has('year'))
							<span class="help-block text-danger">
								<strong>{{ $errors->first('year') }}</strong>
							</span>
							@endif
						</div>
						<div class="form-group has-feedback {{ $errors->has('name') ? 'has-error' : '' }}">
							<label>Tipo de Obra</label>
							<select name="type" class="form-control" required>
								@foreach($types as $type)
									<option value="{{ $type->id }}">{{ $type->name }}</option>
								@endforeach
							</select>
							@if ($errors->has('type'))
							<span class="help-block text-danger">
								<strong>{{ $errors->first('type') }}</strong>
							</span>
							@endif
						</div>
						<div class="form-group has-feedback {{ $errors->has('name') ? 'has-error' : '' }}">
							<label>Autor</label>
							<select name="author" class="form-control" required>
								@foreach($authors as $author)
									<option value="{{ $author->id }}">{{ $author->name }}</option>
								@endforeach
							</select>
							@if ($errors->has('author'))
							<span class="help-block text-danger">
								<strong>{{ $errors->first('author') }}</strong>
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