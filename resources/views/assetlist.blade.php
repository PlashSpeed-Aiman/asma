@extends('shared._layout')
@section('content')
    <div class="container mx-auto">
    <div>
        <small class="badge badge-outline"> Track and manage your assets efficiently</small>
        <div class="overflow-x-auto">
            <table class="table table-zebra">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Asset Name</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Location</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Laptop Dell XPS 13</td>
                        <td>Electronics</td>
                        <td>Active</td>
                        <td>Office 101</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Office Chair</td>
                        <td>Furniture</td>
                        <td>Active</td>
                        <td>Office 102</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>HP Printer</td>
                        <td>Electronics</td>
                        <td>Maintenance</td>
                        <td>Office 103</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Filing Cabinet</td>
                        <td>Furniture</td>
                        <td>Active</td>
                        <td>Office 104</td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>MacBook Pro</td>
                        <td>Electronics</td>
                        <td>Active</td>
                        <td>Office 105</td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td>Conference Table</td>
                        <td>Furniture</td>
                        <td>Active</td>
                        <td>Room 201</td>
                    </tr>
                    <tr>
                        <td>7</td>
                        <td>Projector</td>
                        <td>Electronics</td>
                        <td>Inactive</td>
                        <td>Room 202</td>
                    </tr>
                    <tr>
                        <td>8</td>
                        <td>Whiteboard</td>
                        <td>Office Supplies</td>
                        <td>Active</td>
                        <td>Room 203</td>
                    </tr>
                    <tr>
                        <td>9</td>
                        <td>Water Dispenser</td>
                        <td>Appliances</td>
                        <td>Active</td>
                        <td>Kitchen</td>
                    </tr>
                    <tr>
                        <td>10</td>
                        <td>Security Camera</td>
                        <td>Electronics</td>
                        <td>Active</td>
                        <td>Entrance</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="join mt-4">
            <button class="join-item btn">1</button>
            <button class="join-item btn btn-active">2</button>
            <button class="join-item btn">3</button>
            <button class="join-item btn">4</button>
        </div>
    </div>    </div>

@endsection
