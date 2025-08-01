<?php include('../partials/header.php'); ?>

<h2>Visitor Insight</h2>

<div class="table-container">
  <input type="text" id="searchInput" placeholder="Search IP or User Agent...">
  <table id="visitorsTable">
    <thead>
      <tr>
        <th>IP Address</th>
        <th>User Agent</th>
        <th>Date & Time</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = $result->fetch_assoc()): ?>
      <tr>
        <td><?= htmlspecialchars($row['ip_address']) ?></td>
        <td><?= htmlspecialchars($row['user_agent']) ?></td>
        <td><?= date("F j, Y, g:i a", strtotime($row['created_at'])) ?></td>
      </tr>
      <?php endwhile; ?>
    </tbody>
  </table>

  <button onclick="downloadCSV()">Download CSV</button>
</div>

<?php include('../partials/footer.php'); ?>