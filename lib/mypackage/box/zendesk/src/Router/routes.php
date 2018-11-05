<?php
Route::get('zendesk', 'Box\Zendesk\Controller\AuthController@index');
Route::post('zendesk/checkauth', 'Box\Zendesk\Controller\AuthController@checkAuth');
Route::get('zendesk/search-user', 'Box\Zendesk\Controller\UserController@search');
Route::post('zendesk/search-user', 'Box\Zendesk\Controller\UserController@searchPost');
Route::post('zendesk/search-user/search', 'Box\Zendesk\Controller\UserController@searchPost');
Route::get('zendesk/chat', 'Box\Zendesk\Controller\ChatController@index');
Route::get('zendesk/chat/all', 'Box\Zendesk\Controller\ChatController@GetChat');
Route::post('zendesk/chat', 'Box\Zendesk\Controller\ChatController@PostChat');
Route::put('zendesk/chat', 'Box\Zendesk\Controller\ChatController@PutChat');
