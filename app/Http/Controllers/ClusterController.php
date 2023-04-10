<?php

namespace App\Http\Controllers;

use App\Models\Clusters;
use Illuminate\Http\Request;

class ClusterController extends Controller
{
    public function getAllClusters() {
        $clusters = Clusters::get();
        return view('content.clusters.list')->with('clusters', $clusters);
    }

    public function deleteClusterById(Request $request) {
        $clusters = Clusters::find($request->id);
        $clusters->delete();
        return redirect('/clusters');
    }

    public function createCluster(Request $request) {
        $clusters = new Clusters();
        $clusters->cluster = $request->cluster;
        $clusters->ip = $request->ip;
        $clusters->port = $request->port;
        $clusters->user = $request->user;
        $clusters->password = $request->password;
        $clusters->description = $request->description;
        $clusters->save();
        return redirect('/clusters');
    }

    public function updateClusterById(Request $request) {
        $clusters = Clusters::find($request->u_clusters_id);
        $clusters->cluster = $request->u_cluster;
        $clusters->ip = $request->u_ip;
        $clusters->port = $request->u_port;
        $clusters->user = $request->u_user;
        $clusters->password = $request->u_password;
        $clusters->description = $request->u_description;
        $clusters->save();
        return redirect('/clusters');
    }

    public function notFound() {
        return view('content.clusters.notFound');
    }
}
