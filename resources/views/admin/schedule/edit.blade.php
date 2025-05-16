@extends('layouts.admin')

@section('title')
    {{ __('Edit Schedule') }} <!-- Updated title -->
@endsection

@section('header')
  <h1 class="h3 mb-3">Update Schedule</h1>
@endsection

@section('content')
  <section class="row">
    <div class="col-12 d-flex align-items-center justify-content-center">
      <div class="col-6">
        <!-- Corrected $schedul to $schedule -->
        <form action="{{ Auth::user()->role->slug === 'super-admin' ? route('schedule.update', $schedule->id) : ( Auth::user()->role->slug === 'administrator' ? route('admin.schedule.update', $schedule->id) : route('moderator.schedule.update', $schedule->id) ) }}" method="post">
          @csrf
          @method('put')
          <div class="card flex-fill">
            <div class="card-header">
              <h5 class="card-title mb-0">{{ __('Update Schedule') }}</h5>
            </div>
            <div class="card-body py-0">
              <div class="row g-3">
                <div class="col-12">
                  <input type="text" name="title" class="form-control" id="title" placeholder="{{ __('Title') }}" value="{{ $schedule->title }}" required />
                </div>
                <div class="col-12">
                  <input type="time" name="time_in" class="form-control" id="time_in" placeholder="{{ __('Time In') }}" value="{{ $schedule->time_in }}" required /> <!-- Unique ID -->
                </div>
                <div class="col-12">
                  <input type="time" name="time_out" class="form-control" id="time_out" placeholder="{{ __('Time Out') }}" value="{{ $schedule->time_out }}" required /> <!-- Unique ID -->
                </div>
              </div>
            </div>
            <div class="card-footer">
              <div class="row">
                <div class="col-6 d-grid">
                  <!-- Removed $schedule->id from index routes -->
                  <a href="{{ Auth::user()->role->slug === 'super-admin' ? route('schedule.index') : (Auth::user()->role->slug === 'administrator' ? route('admin.schedule.index') : route('moderator.schedule.index') ) }}" class="btn btn-outline-secondary">
                    <i class="align-middle me-1" data-feather="arrow-left"></i>
                    <span class="ps-1">{{ __('Discard') }}</span>
                  </a>
                </div>
                <div class="col-6 d-grid">
                  <button type="submit" class="btn btn-outline-secondary">
                    <i class="align-middle me-1" data-feather="check"></i>
                    <span class="ps-1">{{ __('Update') }}</span>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </section>
@endsection

@section('script')
@endsection