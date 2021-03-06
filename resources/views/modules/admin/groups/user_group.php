<!-- declare our angular app and controller -->
<form ng-submit="to_assign()" ng-controller="groupUserController">
    <div class="row"  >
	  <p class="text-center" ng-show="loading"><span class="fa fa-spinner fa-5x fa-spin"></span></p>
	  <!-- lista de usuario-->
	  <div class="col-md-6 col-sm-6">
		  <div class="portlet light tasks-widget bordered">
			  <div class="portlet-title">
				  <div class="caption">
					  <i class="icon-share font-green-haze hide"></i>
					  <span class="caption-subject font-green bold uppercase">Usuarios</span>
					  <span class="caption-helper">Listado de Usuarios Activos</span>
				  </div>
				  <div class="actions">
					  <div class="btn-group">
						  <button type="button" class="btn btn-circle grey-mint" ng-click="isChecked_user_all()" >Seleccionar Todos </button>
					  </div>
					  <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title=""> </a>
				  </div>
			  </div>
			  <div class="portlet-body">
				  <div class="task-content">
					  <div class="scroller" style="height: 312px;" data-always-visible="1" data-rail-visible1="1">
						  <!-- START TASK LIST -->
						  <ul class="task-list">
							<!-- <pre>{{user_check_data | json}}</pre>-->
                             <li class="user" ng-hide="loading" ng-repeat="user in users track by $index">
                                 <!--<div class="task-checkbox">
                                     <input type="checkbox" class="" value="" /> </div>-->
								  <div class="task-title">
									<input type="checkbox" class="icheck" ng-change="sync(user_check, user.user)" ng-model="user_check" ng-checked="isChecked(user.user.id)">
									  <span class="task-title-sp"> {{ user.user.username }}</span>
									  <span class="btn btn-circle default green-stripe" ng-hide="loading" ng-repeat="user_group in users[$index].group" >{{ user_group.groups.group.name }}
									  <a class="done" href="" ng-click="delete_user_group(user.user.id,user_group.groups.group.id)">
										<i class="fa fa-close"></i>
									  </a>
									  </span>
								  </div>
							  </li>
						  </ul>
						  <!-- END START TASK LIST -->
					  </div>
				  </div>
                  <!-- <div class="task-footer">
                    <div class="btn-arrow-link pull-right">
                        <a href=""  ng-click="to_assign()" >Asignar a</a>
                        <i class="icon-arrow-right"></i>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
    <!-- fin lista de usuario-->

	  <!-- lista de grupos-->
	  <div class="col-md-6 col-sm-6">
		  <div class="portlet light tasks-widget bordered">
			  <div class="portlet-title">
				  <div class="caption">
					  <i class="icon-share font-yellow-haze hide"></i>
					  <span class="caption-subject font-green-meadow bold uppercase">Grupos</span>
					  <span class="caption-helper">Listado de Grupos Activos</span>
				  </div>
				  <div class="actions">
					  <div class="btn-group">
						  <button type="button" class="btn btn-circle grey-mint" ng-click="isChecked_group_all()">Seleccionar Todos</button>
					  </div>
					  <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title=""> </a>
				  </div>
			  </div>
			  <div class="portlet-body">
				  <div class="task-content">
					  <div class="scroller" style="height: 312px;" data-always-visible="1" data-rail-visible1="1">
						  <!-- START TASK LIST -->
						  <ul class="task-list">
							<!--<pre>{{group_check_data | json}}</pre>-->
							  <li ng-hide="loading" ng-repeat="group in groups">
									  <div class="task-title">
										<input type="checkbox" class="icheck" ng-change="sync_group(group_check, group)" ng-model="group_check" ng-checked="isChecked_group(group.id)">
										  <span class="task-title-sp" > {{ group.name }} </span>
									  </div>
							  </li>
						  </ul>
						  <!-- END START TASK LIST -->
					  </div>
				  </div>
			  </div>
		  </div>
	  </div>
	  <!-- fin lista de grupos-->
    </div>   <!-- fin row 1-->

    <div class="text-center" ng-controller="accessUsersController" >
        <input type="hidden"  ng-init="menu_modules = 5">
        <button type="submit" class="btn blue" ng-disabled="acc_insert" >Guardar</button>
    </div>
</form>
    <div class="row"  ng-controller="groupUserController">
	<!-- usuarios asignados a grupos -->
        <div class="col-lg-12">
            <div class="portlet light portlet-fit bordered">

                <div class="portlet-body">
                    <div class="mt-element-list">
                      <a class="list-toggle-container font-white" data-toggle="collapse" href="#lista-grupo" aria-expanded="false">
                          <div class="mt-list-head list-todo green">
                              <div class="list-head-title-container">
                                  <h3 class="list-toggle-title bold list-title">Usuarios Asignados a Grupos</h3>
                                  <div class="list-head-count">
                                      <div class="list-head-count-item">
                                          <i class="fa fa-user"></i> {{ group_users.length }}</div>
                                      <div class="list-head-count-item">
                                          <i class="fa fa-users"></i> {{ users.length }}</div>
                                  </div>
                              </div>
                              <div class="list-count pull-right green-meadow">
                                <i class="fa fa-plus"></i>
                              </div>

                          </div>
                        </a>
                        <div class="mt-list-container list-todo task-list panel-collapse collapse" id="lista-grupo">
                            <div class="list-todo-line red"></div>
                            <ul>
                                <li class="mt-list-item" ng-hide="loading" ng-repeat="group_user in group_users track by $index" >
                                    <div class="list-todo-icon bg-white font-green-meadow">
                                        <i class="fa fa-users"></i>
                                    </div>
                                    <div class="list-todo-item green-meadow">
                                        <a class="list-toggle-container font-white" data-toggle="collapse" href="#task-{{$index+1}}-2" aria-expanded="false">
                                            <div class="list-toggle done uppercase">
                                                <div class="list-toggle-title bold">{{ group_user.group.name }}</div>
                                                <div class="badge badge-default pull-right bold">{{ group_user.user.length }}</div>
                                            </div>
                                        </a>
                                        <div class="task-list panel-collapse collapse" id="task-{{$index+1}}-2">
                                            <ul>
                                                <li class="task-list-item done"  ng-hide="loading" ng-repeat="user_data in group_user.user ">
                                                    <div class="task-icon" ng-hide="loading">
                                                        <img src="/img/profile/{{user_data.profile[0].profile.avatar}}"  class="img-circle" alt="" width="50px" height="52px"  >
                                                    </div>
                                                    <div class="task-status">
                                                        <a class="done" href="" ng-click="delete_user_group(user_data.users.id,group_user.group.id)">
                                                            <i class="fa fa-close"></i>
                                                        </a>
                                                    </div>
                                                    <div class="task-content">
                                                        <h4 class="uppercase bold">
                                                            <a href="javascript:;">{{  user_data.users.username }}   </a>
                                                        </h4>
                                                        <p>{{  user_data.profile[0].profile.name }}</p>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	<!-- fin de usuarios asignados a grupos -->
    </div> 	<!-- fin de row2 -->



