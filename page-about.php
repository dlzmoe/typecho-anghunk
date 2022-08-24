<?php

/**
 * 关于
 *
 * @package custom
 */

$this->need('header.php'); ?>
<div class="main">
    <?php $this->need('component/nav.php'); ?>
    <div class="container">
        <div class="main-content">
            <div class="content" itemprop="articleBody">
                <div id="main" style="width:100%;height:400px;max-width:100%"></div>
  <script src="https://cdn.zburu.com/list/echarts.js"></script>
  <script>
    var myChart = echarts.init(document.getElementById('main'));

    myChart.setOption({
      title: {
        text: '类别统计',
        subtext: 'category',
        left: 'center'
      },
      tooltip: {
        trigger: 'item'
      },
      legend: {
        orient: 'vertical',
        left: 'left'
      },
      series: [
        {
          name: '',
          type: 'pie',
          radius: '50%',
          label: {
            normal: {
              show: true,
              formatter: '{b} {c}({d}%)',
              fontSize: '14',
            }
          },
          data: [
           <?php $this->widget('Widget_Metas_Category_List')
    ->parse('{ value: {count}, name: "{name}" },'); ?>
          ],
          emphasis: {
            itemStyle: {
              shadowBlur: 10,
              shadowOffsetX: 0,
              shadowColor: 'rgba(0, 0, 0, 0.5)',
            },
          }
        }
      ]
    });
  </script>
                <?php $this->content(); ?>
            </div>
        </div>
    </div>
    <div class="container">
		<?php $this->need('footer.php'); ?>
	</div>
</div>
</body>

</html>