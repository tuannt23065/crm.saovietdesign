@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.expense.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.expenses.update", [$expense->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="title">{{ trans('cruds.expense.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', $expense->title) }}" required>
                @if($errors->has('title'))
                    <span class="text-danger">{{ $errors->first('title') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.expense.fields.title_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.expense.fields.description') }}</label>
                <input class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" type="text" name="description" id="description" value="{{ old('description', $expense->description) }}">
                @if($errors->has('description'))
                    <span class="text-danger">{{ $errors->first('description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.expense.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="expense_category_id">{{ trans('cruds.expense.fields.expense_category') }}</label>
                <select class="form-control select2 {{ $errors->has('expense_category') ? 'is-invalid' : '' }}" name="expense_category_id" id="expense_category_id">
                    @foreach($expense_categories as $id => $entry)
                        <option value="{{ $id }}" {{ (old('expense_category_id') ? old('expense_category_id') : $expense->expense_category->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('expense_category'))
                    <span class="text-danger">{{ $errors->first('expense_category') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.expense.fields.expense_category_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="entry_date">{{ trans('cruds.expense.fields.entry_date') }}</label>
                <input class="form-control date {{ $errors->has('entry_date') ? 'is-invalid' : '' }}" type="text" name="entry_date" id="entry_date" value="{{ old('entry_date', $expense->entry_date) }}">
                @if($errors->has('entry_date'))
                    <span class="text-danger">{{ $errors->first('entry_date') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.expense.fields.entry_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="amount">{{ trans('cruds.expense.fields.amount') }}</label>
                <!-- <input class="form-control {{ $errors->has('amount') ? 'is-invalid' : '' }}" type="number" name="amount" id="amount" value="{{ old('amount', $expense->amount) }}" step="0.01" required> -->
                
                <input class="form-control {{ $errors->has('amount') ? 'is-invalid' : '' }}" type="text" id="amount" value="{{ old('amount', $expense->amount) }}" step="0.01" required>
                <input type="hidden" name="amount" id="real_amount" value="{{ old('amount', $expense->amount) }}">
                
                @if($errors->has('amount'))
                    <span class="text-danger">{{ $errors->first('amount') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.expense.fields.amount_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
@parent
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var amountInput = document.getElementById('amount');
        var realAmountInput = document.getElementById('real_amount');

        amountInput.addEventListener('input', function() {
            var value = this.value.replace(/\./g, '');
            if (isNaN(value) || value === '') {
                realAmountInput.value = '';
                this.value = '';
            } else {
                realAmountInput.value = value;
                this.value = parseFloat(value).toLocaleString('vi-VN');
            }
        });

        // Format initial value
        var initialValue = amountInput.value;
        if (initialValue) {
            amountInput.value = parseFloat(initialValue).toLocaleString('vi-VN');
            realAmountInput.value = initialValue;
        }
    });

</script>
@endsection