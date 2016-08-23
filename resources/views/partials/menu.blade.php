        <div class="col-md-2 menu">
            <ul class="sidebar-nav " id="menu">
                <li  class="hvr-pulse"role="presentation" >
                    <a id="trigger" href="#">Bite me pls</a>
                </li>
                <li class="hvr-float"role="presentation" style="display:block" >
                    <a href="{{route('index')}}">Events</a>
                </li>
                <li class="hvr-float"role="presentation" style="display:block">
                    <a href="{{route('user.profile.get')}}">User profile</a>
                </li>
                <li class="hvr-float" role="presentation" style="display:block">
                    <a href="{{route('user.event.create.get')}}">Create event</a>
                </li>
                <li class="hvr-float"role="presentation" style="display:block">
                    <a href="{{route('user.event.joined.get')}}">Joined events</a>
                </li>
                <li class="hvr-float"role="presentation" style="display:block">
                    <a href="{{route('user.event.history.get')}}">History</a>
                </li>
                <li class="hvr-float"role="presentation" style="display:block">
                    <a href="{{route('auth.logout.get')}}">Log out</a>
                </li>
            </ul>
        </div>