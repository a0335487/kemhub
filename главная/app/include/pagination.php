<nav aria-label="Page navigation example">
  <ul class="pagination justify-content-end">
    <li class="page-item">
        <a class="page-link page-link-2" href="?page=1"><<</a>
    </li>
    
    <?if($page > 1):?>
        <li class="page-item">
            <a class="page-link page-link-2" href="?page=<?echo ($page - 1);?>"><</a>
        </li>
    <?endif;?>
    <?if($page < $total_pages || $page == 1):?>
        <li class="page-item">
            <a class="page-link page-link-2" href="?page=<?echo ($page + 1);?>">></a>
        </li>
    <?endif;?>

    <li class="page-item">
      <a class="page-link page-link-2" href="?page=<?echo $total_pages;?>">>></a>
    </li>
  </ul>
</nav>