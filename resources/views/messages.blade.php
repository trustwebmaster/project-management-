<div class="">
  <h2>Materials in stock </h2>
  <br>
  <table class="table table-bordered">
    <thead class=".thead-dark">
      <tr>
        <th>Product Name</th>
        <th>Quantity</th>
        <th>Date</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($items as $item)    
        <tr>
          <td>{{ $item['product_name'] }}</td>
          <td>{{ $item['quantity'] }}</td>
          <td>{{ $item['created_at'] }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>
