package com.example.projectamazon;

public class UserLocationDetails {
    String userEmail;
    String userLat;
    String userLong;
    String userDate;
    String userTime;

    public UserLocationDetails(){

    }

    public UserLocationDetails(String userEmail ,String userLat ,String userLong , String userDate , String userTime){
        this.userDate = userDate;
        this.userEmail = userEmail;
        this.userLat = userLat;
        this.userLong = userLong;
        this.userTime = userTime;

    }
    public String getUserEmail(){
        return userEmail;
    }

    public String getUserLat(){
        return userLat;
    }

    public String getUserLong(){
        return userLong;
    }

    public String getUserDate(){
        return userDate;
    }

    public String getUserTime(){
        return userTime;
    }

}
