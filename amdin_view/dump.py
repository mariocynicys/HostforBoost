################
    for i in range(150):
        ttk.Label(scrollable_frame,text=i+1).grid(row=i+1,column=0,ipadx=1,ipady=1)
        ttk.Label(scrollable_frame,text="User Name",highlightthickness=1, highlightbackground="black").grid(row=i+1,column=1,ipadx=1,ipady=1)
        ttk.Label(scrollable_frame,text="Game ID",highlightthickness=1, highlightbackground="black").grid(row=i+1,column=2,ipadx=1,ipady=1)
        ttk.Label(scrollable_frame,text="Game Name",highlightthickness=1, highlightbackground="black").grid(row=i+1,column=3,ipadx=1,ipady=1)
        ttk.Label(scrollable_frame,text="Game State",highlightthickness=1, highlightbackground="black").grid(row=i+1,column=4,ipadx=1,ipady=1)
        ttk.Label(scrollable_frame,text="Start Time",highlightthickness=1, highlightbackground="black").grid(row=i+1,column=5,ipadx=1,ipady=1)
        ttk.Label(scrollable_frame,text="End Time",highlightthickness=1, highlightbackground="black").grid(row=i+1,column=6,ipadx=1,ipady=1)
    #################
    subwindow.geometry("1450x480+400+200")
    