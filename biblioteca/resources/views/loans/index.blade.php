@extends('layouts.app')

@section('title', 'Empréstimos')

@section('sidebar')
    @parent
@endsection

@section('content')
<div class="container">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
						<h2><b>Empréstimos</b></h2>
					</div>
					<div class="col-sm-6">
						<a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Adicionar</span></a>					
					</div>
                </div>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Data do Empréstimo</th>
                        <th>Data da Devolução Prevista</th>
						<th>Título da Obra</th>
						<th>Aluno</th>
						<th>RA</th>
						<th>Data da Devolução</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
					@foreach($loans as $loan)
                    <tr>
                        <td>{{ date('d/m/Y', strtotime($loan->loan_date)) }}</td>
                        <td>{{ date('d/m/Y', strtotime($loan->return_date_expected)) }}</td>
						<td>{{ $loan->exemplary->works->title }}</td>
						<td>{{ $loan->user->name }}</td>
						<td>{{ $loan->user->student->ra }}</td>
						<td>
							@if($loan->devolution->date_devolution!=null)
								{{ $loan->devolution->date_devolution }}
							@else
								-
							@endif
						</td>
                        <td>
							@if($loan->devolution->date_devolution==null)
                            	<a href="#editEmployeeModal{{ $loan->id }}" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Editar">&#xE254;</i></a>								
							@endif
                        </td>
					</tr>
					@if($loan->devolution->date_devolution==null)
					<!-- Edit Modal HTML -->
					<div id="editEmployeeModal{{ $loan->id }}" class="modal fade">
						<div class="modal-dialog">
							<div class="modal-content">
								<form method="POST" action="{{ route('loans.update', $loan->id) }}">
									@csrf
									@method('PATCH')
									<div class="modal-header">						
										<h4 class="modal-title">Devolução</h4>
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									</div>
									<div class="modal-body">					
									</div>
									<div class="modal-footer">
										<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
										<input type="submit" class="btn btn-success" value="Devolver">
									</div>
								</form>
							</div>
						</div>
					</div>
					@endif
					@endforeach
                </tbody>
            </table>
			<div class="clearfix">
			<div class="hint-text"><b>{{ $loans->currentPage() }}</b> de <b>{{ $loans->lastPage() }}</b></div>
				{{ $loans->links() }}
            </div>
        </div>
    </div>
	<!-- Add Modal HTML -->
	<div id="addEmployeeModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form method="POST" action="{{ route('loans.store') }}">
					@csrf
					@method('POST')
					<div class="modal-header">						
						<h4 class="modal-title">Adicionar Empréstimo</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">					
						<div class="form-group">
							<label>Data do Empréstimo</label>
							<input type="date" name="loan_date" class="form-control" value="{{ $date }}"  required>
						</div>
						<div class="form-group">
							<label>Data de Devolução Prevista</label>
							<input type="date" name="return_date_expected" class="form-control" value="{{ $date }}" required>
						</div>
						<div class="form-group">
							<label>Obra</label>
							<select name="exemplary_id" class="form-control" required>
								@foreach($exemplaries as $exemplary)
									<option value="{{ $exemplary->id }}">{{ $exemplary->works->title }}</option>
								@endforeach
							</select>
							@if ($errors->has('exemplary'))
							<span class="help-block text-danger">
								<strong>{{ $errors->first('exemplary') }}</strong>
							</span>
							@endif
						</div>
						<div class="form-group">
							<label>Aluno</label>
							<select name="user_id" class="form-control" required>
								@foreach($students as $student)
									<option value="{{ $student->user->id }}">{{ $student->user->name }}</option>
								@endforeach
							</select>
							@if ($errors->has('student'))
							<span class="help-block text-danger">
								<strong>{{ $errors->first('student') }}</strong>
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