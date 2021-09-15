### Create a simple API with laravel 8 

Remember the study of laravel in my profile. I will use some terms and method here. 
Give a look on my project: https://github.com/Gessilt/Lavarel-study. Thanks.

# What is API? 

Aplication Programmimg Interface, a algorithms (set of routines and standards) establiished by a software.

Comes to simplify the development of programs and applications. 

# API web

A set of interfaces in the context of the web development , usually in XML or JSON format. The most used technique is REST.

# REST?

Representational State Transfer, a framework, which define restrictions to web services. The web services that comply are called RESTful.

## RESTful

- Managed by HTTP verbs;
- Stateless communication between client and server. Each request is separate and no information is stored between;
- Data is cached;
- Uniform interface between components so that information is standardized;
  - The user needs to receive the data in a way that he can identify it;
  - The user can manipulate the data recieved;
  - Messages sent to user must to be self-explanatory;
  - The hypermidia must be integrated. To user see what he can do.
- It needs a layer that organizes the servers, with all their functions, involved in retrieving requested information.

# Create 

## The project in laravel:

```bash 
composer create-project laravel/laravel example-app 

```

A new database, in the case of this project, "artigos" or "articles" - on english - , the project is using MySql workbench.

## Migration:

```bash 
php artisan make:migration create_artigos_table --create=artigos 
```

The --create=artigos will change the Schema name automatically. 

Like: ```bash Schema::create('artigos', function (Blueprint $table) { ```

Go to new folder, enter in the migration archive, and create two new columns, a string "titulo" or "title"
and a text "conteudo" or "content".

## Model

Create it normally, ```php artisan make:model Artigo```, don't forget migrate the data to the new model. 

## Controller

```bash php artisan make:controller ArtigoController --resource ```

The ```bash --resource ``` make automatically methods with HTTP verbs.

# Working

## Build routes

Take a look in the name of route, is conventional to HTTP verbs.

```bash
<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArtigoController;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// List artigos
Route::get('artigos', [ArtigoController::class, 'index']);

// List single artigo
Route::get('artigo/{id}', [ArtigoController::class, 'show']);

// Create new artigo
Route::post('artigo', [ArtigoController::class, 'store']);

// Update artigo
Route::put('artigo/{id}', [ArtigoController::class, 'update']);

// Delete artigo
Route::delete('artigo/{id}', [ArtigoController::class,'destroy']);

```

## Build the resource

A new thing, i've never seen this before the crate of this API. 
What is? 

The resource make the communication between the JSON data and the eloquent models, transform the JSON object in arrays and the arrays in JSON objects. Now, it's more simplest, don't you think?

### Artisan command

Execute it

### Inside resource 

```bash
<?php

namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;

class Artigo extends JsonResource {
  public function toArray($request){
    //return parent::toArray($request);
    return [
      'id' => $this->id,
      'titulo' => $this->titulo,
      'conteudo' => $this->conteudo
    ];
  }

  /* public function with( $request ){
    return [
      'version' => '1.0.0',
      'author_url' => url('https://terminalroot.com.br')
    ];
  } */
}

```

Why "$this"?? It references to it own class? But where is the attributes? 
The resource make it simple. $this reference to the modal which is correspondent of this resource. 

Ok, but how works? If you call it with the modal, regardless of what it is, in the controller it will execute and call the resource.
Pay attention to the data specified in the resource, if it is a resource other than the class, it will give an error or will not work as expected. 

## Build the controller

Take a look in the methods names, They are all in the convention for HTTP verbs

```bash
<?php

namespace App\Http\Controllers;

use App\Models\Artigo as Artigo;
use App\Http\Resources\Artigo as ArtigoResource;
use Illuminate\Http\Request;

class ArtigoController extends Controller {

  public function index(){
    $artigos = Artigo::paginate(15);
    return ArtigoResource::collection($artigos);
  }

  public function show($id){
    $artigo = Artigo::findOrFail( $id );
    return new ArtigoResource( $artigo );
  }

  public function store(Request $request){
    $artigo = new Artigo;
    $artigo->titulo = $request->input('titulo');
    $artigo->conteudo = $request->input('conteudo');

    if( $artigo->save() ){
      return new ArtigoResource( $artigo );
    }
  }

   public function update(Request $request){
    $artigo = Artigo::findOrFail( $request->id );
    $artigo->titulo = $request->input('titulo');
    $artigo->conteudo = $request->input('conteudo');

    if( $artigo->save() ){
      return new ArtigoResource( $artigo );
    }
  } 

  public function destroy($id){
    $artigo = Artigo::findOrFail( $id );
    if( $artigo->delete() ){
      return new ArtigoResource( $artigo );
    }

  }
}
```

# End, now test it.

To run it, you will need start the laravel by:

```bash
php artisan serve
```

To use the api, put in your URL, localhost:127.0.0.1/api/methodname 


