<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Schedule') }}
        </h2>
    </x-slot>
    <br>
    @if(isset($error) && $error)
    <div id="errorAlert" class="alert alert-danger position-fixed bottom-0 right-0" role="alert" style="margin-right: 15px; margin-bottom: 15px;">
        <strong>Error</strong> Schedule has already been set.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <script>
        // Automatically close the alert after 5 seconds (5000 milliseconds)
        setTimeout(function() {
            document.getElementById('errorAlert').style.display = 'none';
        }, 5000);
    </script>
@endif
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class=" dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="button">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                            Schedule a Tech
                        </button></div><br>
                      <table class="table table-hover   ">
                        <thead style="background:#111827">
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Monday</th>
                            <th scope="col">Tuesday</th>
                            <th scope="col">Wednesday</th>
                            <th scope="col">Thursday</th>
                            <th scope="col">Friday</th>
                            <th scope="col">Saturday</th>
                            <th scope="col">Sunday</th>
                            <th scope="col">Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user )
                            @foreach ($user->schedules as $schedule)

                          <tr>
                            <th scope="row">1</th>
                            <td>{{$user->name}}</td>
                            <td>{{$schedule->mon}}</td>
                            <td>{{$schedule->tue}}</td>
                            <td>{{$schedule->wed}}</td>
                            <td>{{$schedule->thu}}</td>
                            <td>{{$schedule->fri}}</td>
                            <td>{{$schedule->sat}}</td>
                            <td>{{$schedule->sun}}</td>
                            <td>Edit</td>
                          </tr>
                          @endforeach
                          @endforeach
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="/setSched">
                    @csrf
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Scheduler</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">
                    <div class="form-group">
                        <label for="employee">Select a tech</label>
                        <div class="input-group">
                            <select name="tech" id="tech">
                                @foreach ($users as $user)
                                <option value="{{$user->id }}">{{$user->name}}</option>
                                @endforeach
                            </select>
                        </div><br>
                        <table class="table">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">Day</th>
                                <th scope="col">Site</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                <th scope="row">Monday</th>
                                <td>
                                    <div class="input-group">
                                        <select name="mon" id="mon">
                                            <option value="" disabled selected>Select an option</option>
                                            @foreach ($sites as $site)
                                            <option value="{{$site->Site}}">{{$site->Site}}</option>
                                        @endforeach
                                        <option value="Leave">Leave</option>
                                            <option value="Virtual Meeting">Virtual Meeting</option>
                                        </select>
                                        </div>
                                </td>
                                </tr>
                                <tr>
                                <th scope="row">Tuesday</th>
                                <td>
                                    <div class="input-group">
                                        <select name="tue" id="tue">
                                            <option value="" disabled selected>Select an option</option>
                                            @foreach ($sites as $site)
                                            <option value="{{$site->Site}}">{{$site->Site}}</option>
                                        @endforeach
                                        <option value="Leave">Leave</option>
                                            <option value="Virtual Meeting">Virtual Meeting</option>
                                        </select>
                                        </div>
                                </td>
                                </tr>
                                <tr>
                                <th scope="row">Wednesday</th>
                                <td>
                                    <div class="input-group">
                                        <select name="wed" id="wed">
                                            <option value="" disabled selected>Select an option</option>
                                            @foreach ($sites as $site)
                                            <option value="{{$site->Site}}">{{$site->Site}}</option>
                                        @endforeach
                                        <option value="Leave">Leave</option>
                                            <option value="Virtual Meeting">Virtual Meeting</option>
                                        </select>
                                        </div>
                                </td>
                                </tr>
                                <tr>
                                <th scope="row">Thursday</th>
                                <td>
                                    <div class="input-group">
                                        <select name="thu" id="thu">
                                            <option value="" disabled selected>Select an option</option>
                                            @foreach ($sites as $site)
                                            <option value="{{$site->Site}}">{{$site->Site}}</option>
                                        @endforeach
                                        <option value="Leave">Leave</option>
                                            <option value="Virtual Meeting">Virtual Meeting</option>
                                        </select>
                                        </div>
                                </td>
                                </tr>
                                <tr>
                                    <th scope="row">Friday</th>
                                    <td>
                                        <div class="input-group">
                                            <select name="fri" id="fri">
                                                <option value="" disabled selected>Select an option</option>
                                                @foreach ($sites as $site)
                                                <option value="{{$site->Site}}">{{$site->Site}}</option>
                                            @endforeach
                                            <option value="Leave">Leave</option>
                                            <option value="Virtual Meeting">Virtual Meeting</option>
                                            </select>
                                            </div>
                                    </td>
                                </tr>
                                <tr>
                                <th scope="row">Saturday</th>
                                <td>
                                    <div class="input-group">
                                        <select name="sat" id="sat">
                                            <option value="Weekend" disabled selected>Weekend</option>
                                            @foreach ($sites as $site)
                                            <option value="{{$site->Site}}">{{$site->Site}}</option>
                                        @endforeach
                                        <option value="Leave">Leave</option>
                                            <option value="Virtual Meeting">Virtual Meeting</option>
                                        </select>
                                        </div>
                                </td>
                                </tr>
                                <tr>
                                    <th scope="row">Sunday</th>
                                    <td>
                                        <div class="input-group">
                                        <select name="sun" id="sun">
                                            <option value="Weekend">Weekend</option>
                                            @foreach ($sites as $site)
                                            <option value="{{$site->Site}}">{{$site->Site}}</option>
                                            @endforeach
                                            <option value="Leave">Leave</option>
                                            <option value="Virtual Meeting">Virtual Meeting</option>
                                        </select>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>

                        </table>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-secondary">Submit</button>

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>

                </form>
            </div>
        </div>
    </div>
