<html>

<head>
  <link rel="stylesheet" href="../../assets/css/style.css">
</head>

<body>
    <!-- HEADER -->

    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href="<?php echo base_url(); ?>">Daejeon Hub!</a>
        </div>

        <div class="navbar-collapse collapse navbar-right paddingTop">
          <div class="btn-group">
          <a onclick="main();" class="btn btn-primary" href="<?php echo base_url(); ?>topic/new_form"><i class="glyphicon glyphicon-pencil padding-7px"></i>Create a Topic</a>
        </div>
          <div class="btn-group">
              <a class="btn btn-info menu" href="<?php echo base_url(); ?>topic/all">
                <i class="glyphicon glyphicon-list-alt padding-7px"></i>All topics</a>
            </div>
            <div class="btn-group">
              <a class="btn btn-info menu" href="<?php echo base_url(); ?>category/all">
                <i class="glyphicon glyphicon-list-alt padding-7px"></i>All categories</a>
            </div>  
            <div class="btn-group">
                <a class="btn btn-warning menu" href="<?php echo base_url(); ?>topic/mytopics">
                  <i class="glyphicon glyphicon-th-list padding-7px"></i>My topics</a>
            </div>
            <div class="btn-group">
                <a class="btn btn-success menu" href="<?php echo base_url(); ?>user/show"><i class="glyphicon glyphicon-user padding-7px"></i><?php echo $username; ?></a>
            </div>
            <div class="btn-group">
              <a class="btn btn-danger" href="<?php echo base_url(); ?>home/logout">
                <i class="glyphicon glyphicon-off padding-7px"></i>Logout</a>
            </div>

        </div>

      </div>
    </div>
</body>
</html><html>

<head>
  <link rel="stylesheet" href="../../assets/css/style.css">
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
</head>

<body>
    <!-- HEADER -->

    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href="<?php echo base_url(); ?>">Daejeon Hub!</a>
        </div>

        <div class="navbar-collapse collapse navbar-right paddingTop">
          <div class="btn-group">
          <a onclick="main();" class="btn btn-primary" href="<?php echo base_url(); ?>topic/new_form"><i class="glyphicon glyphicon-pencil padding-7px"></i>Create a Topic</a>
        </div>
          <div class="btn-group">
              <a class="btn btn-info menu" href="<?php echo base_url(); ?>topic/all">
                <i class="glyphicon glyphicon-list-alt padding-7px"></i>All topics</a>
            </div>
            <div class="btn-group">
              <a class="btn btn-info menu" href="<?php echo base_url(); ?>category/all">
                <i class="glyphicon glyphicon-list-alt padding-7px"></i>All categories</a>
            </div>
            <div class="btn-group">
              <a class="btn btn-warning menu" href="<?php echo base_url(); ?>topic/mytopics">
                <i class="glyphicon glyphicon-th-list padding-7px"></i>My topics</a>
            </div>
            <?php if($totalAnswersNotSeen[0]->total != 0){ ?>
              <span class="answerFeed"><?php echo $totalAnswersNotSeen[0]->total; ?></span>
            <?php } ?>
            <div class="btn-group">
                <a class="btn btn-success menu" href="<?php echo base_url(); ?>user/show"><i class="glyphicon glyphicon-user padding-7px"></i><?php echo $username; ?></a>
            </div>
            <div class="btn-group">
              <a class="btn btn-danger" href="<?php echo base_url(); ?>home/logout">
                <i class="glyphicon glyphicon-off padding-7px"></i>Logout</a>
            </div>

        </div>

      </div>
    </div>
</body>
</html>