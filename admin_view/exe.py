import tkinter as ttk
from tkinter import messagebox,Tk,Toplevel,Frame,Scrollbar,Canvas
import time
try:
    import pymysql
    from sqlalchemy import create_engine,Integer,String,Column,DateTime,Boolean,Date,DECIMAL
    from sqlalchemy.orm import sessionmaker
    from sqlalchemy.ext.declarative import declarative_base
except:
    window = Tk()
    window.title("Error")
    window.geometry("0x0")
    messagebox.showerror("Import Error","Please Make Sure That 'SQLAlchmey' & 'pymysql' are installed")
    exit()

Base = declarative_base()

class Admin(Base):
    
    __tablename__ = 'Administrators'
    username = Column('USERNAME',String,primary_key=True)
    password = Column('PASSWORD',String)
    
    def __init__(self,username,password):
        self.username = username
        self.password = password

class User(Base):
    
    __tablename__ = 'Users'
    username = Column('UserName',String,primary_key=True)
    firstname = Column('FirstName',String)
    lastname = Column('LastName',String)
    email = Column('Email',String)
    hashedpassword = Column('HashedPassword',String)
    usertype = Column('UserType',String)
    userpic = Column('UserPic',String)
    isonline = Column('IsOnline',Boolean)
    islocked = Column('IsLocked',Boolean)
    
    def __init__(self,username,firstname,lastname,email,hashedpassword,usertype,userpic,isonline,islocked):
        self.username = username
        self.firstname = firstname
        self.lastname = lastname
        self.email = email
        self.hashedpassword = hashedpassword
        self.usertype = usertype
        self.userpic = userpic
        self.isonline = isonline
        self.islocked = islocked
    
class Game(Base):
    
    __tablename__ = "Game"
    gid = Column('GID',Integer,primary_key=True)
    gname = Column('GName',String)
    gposter = Column('GPoster',String)
    ggenre = Column('GGenre',String)
    grate = Column('GRate',DECIMAL)
    greleaseddate = Column('GReleasedDate',Date)
    gpublisher = Column('GPublisher',String)
    gtrailer = Column('GTrailer',String)
    
    def __init__(self,gid,gname,gposter,ggenre,grate,greleaseddate,gpublisher,gtrailer):
        self.gid = gid
        self.gname = gname
        self.gposter = gposter
        self.ggenre = ggenre
        self.grate = grate
        self.greleaseddate = greleaseddate
        self.gpublisher = gpublisher
        self.gtrailer = gtrailer

class Program(Base):
    
    __tablename__ = "Program"
    pid = Column('PID',Integer,primary_key=True)
    pname = Column('PName',String)
    pposter = Column('PPoster',String)
    preleaseddate = Column('PReleasedDate',Date)
    ppublisher = Column('PPublisher',String)
    
    def __init__(self,pid,pname,pposter,preleaseddate,ppublisher):
        self.pid = pid
        self.pname = pname
        self.pposter = pposter
        self.preleaseddate = preleaseddate
        self.ppublisher = ppublisher

class GameHistory(Base):
    
    __tablename__ = "GamesHistory"
    username = Column('UserName',String,primary_key=True)
    gid = Column('GID',Integer,primary_key=True)
    gstart = Column('GStarted',DateTime,primary_key=True)
    gend = Column('GEnded',String,primary_key=True)
    gstate = Column('GState',Boolean)
    
    def __init__(self,username,gid,gstart,gend,gstate):
        self.username = username
        self.gid = gid
        self.gstart = gstart
        self.gend = gend
        self.gstate = gstate
    
class ProgramHistory(Base):
    __tablename__ = "ProgramsHistory"
    username = Column('UserName',String,primary_key=True)
    pid = Column('PID',Integer,primary_key=True)
    pstart = Column('PStarted',DateTime,primary_key=True)
    pend = Column('PEnded',String,primary_key=True)
    pstate = Column('PState',Boolean)
    
    def __init__(self,username,pid,pstart,pend,pstate):
        self.username = username
        self.pid = pid
        self.pstart = pstart
        self.pend = pend
        self.pstate = pstate

def admin_control():
    '''meh, admin control'''
    global session
    try:
        session = sessionmaker(bind=engine)()
    except:
        return
    clear_window(window)
    window.geometry("400x470")
    
    add_remove_admin_button = ttk.Button(window,text="Update-Password/Add/Remove/View Admin",command=add_remove_admin,)
    add_remove_admin_button.bind("<Return>",add_remove_admin)
    add_remove_admin_button.grid(row=0,column=0,padx=(50,0),pady=(40,0))
    
    view_game_history_button = ttk.Button(window,text="View Game History",command=view_game_history,)
    view_game_history_button.bind("<Return>",view_game_history)
    view_game_history_button.grid(row=1,column=0,padx=(50,0),pady=(40,0))
    
    view_program_history_button = ttk.Button(window,text="View Program History",command=view_program_history,)
    view_program_history_button.bind("<Return>",view_program_history)
    view_program_history_button.grid(row=2,column=0,padx=(50,0),pady=(40,0))
    
    control_games_button = ttk.Button(window,text="View/Delete Games",command=control_games,)
    control_games_button.bind("<Return>",control_games)
    control_games_button.grid(row=3,column=0,padx=(50,0),pady=(40,0))
    
    control_programs_button = ttk.Button(window,text="View/Delete Programgs",command=control_programs,)
    control_programs_button.bind("<Return>",control_programs)
    control_programs_button.grid(row=4,column=0,padx=(50,0),pady=(40,0))
    
    control_users_button = ttk.Button(window,text="View/Delete Users",command=control_users,)
    control_users_button.bind("<Return>",control_users)
    control_users_button.grid(row=5,column=0,padx=(50,0),pady=(40,0))
    
def add_remove_admin(_ = 0):
    subwindow = Toplevel(window)
    subwindow.title("Add/Remove/View Admin")
    subwindow.geometry("450x220+400+200")
    
    username_label = ttk.Label(subwindow,text="Username : ")
    username_label.grid(row=0,column=0,padx=(10,0),pady=(20,0))
    
    username_input = ttk.Entry(subwindow,)
    if is_sudo()=='disabled':
        username_input.insert(0,USERNAME)
        username_input['state'] = 'disabled'
    username_input.grid(row=0,column=1,pady=(20,0))
    
    password_label = ttk.Label(subwindow,text="Password : ")
    password_label.grid(row=1,column=0,padx=(10,0),pady=(10,40))
    
    password_input = ttk.Entry(subwindow,show='\u25CF')
    password_input.grid(row=1,column=1,pady=(10,40))
    
    add_admin_lam = lambda dump = 0 : add_admin(username_input.get(),password_input.get())
    add_button = ttk.Button(subwindow,text="Add",command=add_admin_lam,state=is_sudo())
    add_button.bind("<Return>",add_admin_lam)
    add_button.grid(row=2,column=0,padx=(70,0))
    
    remove_admin_lam = lambda dump=0 : remove_admin(username_input.get())
    remove_button = ttk.Button(subwindow,text="Remove",command=remove_admin_lam,state=is_sudo())
    remove_button.bind("<Return>",remove_admin_lam)
    remove_button.grid(row=2,column=1,)
    
    change_admin_lam = lambda dump=0 : change_admin(username_input.get(),password_input.get())
    change_button = ttk.Button(subwindow,text="Change Password",command=change_admin_lam,)
    change_button.bind("<Return>",change_admin_lam)
    change_button.grid(row=3,column=0,pady=(20,0),padx=(70,0))
    
    view_admin_lam = lambda dump=0 : view_admin()
    view_button = ttk.Button(subwindow,text="View Admins",command=view_admin_lam,state=is_sudo())
    view_button.bind("<Return>",view_admin_lam)
    view_button.grid(row=3,column=1,pady=(20,0),)
    
def view_game_history(_ = 0):
    try:
        history_list = session.query(GameHistory).all()
    except:
        messagebox.showerror("Error","Couldn't Fetch The Game History From The DB")
        session.rollback()
        return
    
    subwindow = Toplevel(window)
    subwindow.title("Game History")
    subwindow.geometry("1920x1080")

    canvas = Canvas(subwindow)
    scrollable_frame = Frame(canvas)
    scrollable_frame.bind("<Configure>",lambda e: canvas.configure(scrollregion=canvas.bbox("all")))
    canvas.create_window((0, 0), window=scrollable_frame, anchor="nw")
    
    scrollbary = Scrollbar(subwindow, orient="vertical", command=canvas.yview)
    scrollbarx = Scrollbar(subwindow, orient="horizontal", command=canvas.xview)
    
    canvas.configure(xscrollcommand=scrollbarx.set)
    canvas.configure(yscrollcommand=scrollbary.set)
    
    scrollbary.pack(side="right", fill="y")
    scrollbarx.pack(side="bottom",fill="x")
    canvas.pack(side="left", fill="both", expand=True)
    
    ttk.Label(scrollable_frame,text="index").grid(row=0,column=0,ipadx=1,ipady=1)
    ttk.Label(scrollable_frame,text="User Name").grid(row=0,column=1,ipadx=1,ipady=1)
    ttk.Label(scrollable_frame,text="Game ID").grid(row=0,column=2,ipadx=1,ipady=1)
    ttk.Label(scrollable_frame,text="Game Name").grid(row=0,column=3,ipadx=1,ipady=1)
    ttk.Label(scrollable_frame,text="Game State").grid(row=0,column=4,ipadx=1,ipady=1)
    ttk.Label(scrollable_frame,text="Start Time").grid(row=0,column=5,ipadx=1,ipady=1)
    ttk.Label(scrollable_frame,text="End Time").grid(row=0,column=6,ipadx=1,ipady=1)
    
    for i in range(len(history_list)):
        gamename="-UNKNOWN-"
        try:
            game = session.query(Game).filter_by(gid=history_list[i].gid).first()
            gamename = game.gname
        except:
            session.rollback()
        ttk.Label(scrollable_frame,text=i+1).grid(row=i+1,column=0,ipadx=1,ipady=1)
        ttk.Label(scrollable_frame,text=history_list[i].username,).grid(row=i+1,column=1,ipadx=1,ipady=1)
        ttk.Label(scrollable_frame,text=history_list[i].gid,).grid(row=i+1,column=2,ipadx=1,ipady=1)
        ttk.Label(scrollable_frame,text=gamename,).grid(row=i+1,column=3,ipadx=1,ipady=1)
        ttk.Label(scrollable_frame,text=history_list[i].gstate,).grid(row=i+1,column=4,ipadx=1,ipady=1)
        ttk.Label(scrollable_frame,text=history_list[i].gstart,).grid(row=i+1,column=5,ipadx=1,ipady=1)
        ttk.Label(scrollable_frame,text=history_list[i].gend,).grid(row=i+1,column=6,ipadx=1,ipady=1)
        
def view_program_history(_ = 0):
    try:
        history_list = session.query(ProgramHistory).all()
    except:
        messagebox.showerror("Error","Couldn't Fetch The Program History From The DB")
        session.rollback()
        return
    
    subwindow = Toplevel(window)
    subwindow.title("Program History")
    subwindow.geometry("1920x1080")
    
    canvas = Canvas(subwindow)
    scrollable_frame = Frame(canvas)
    scrollable_frame.bind("<Configure>",lambda e: canvas.configure(scrollregion=canvas.bbox("all")))
    canvas.create_window((0, 0), window=scrollable_frame, anchor="nw")
    
    scrollbary = Scrollbar(subwindow, orient="vertical", command=canvas.yview)
    scrollbarx = Scrollbar(subwindow, orient="horizontal", command=canvas.xview)
    
    canvas.configure(xscrollcommand=scrollbarx.set)
    canvas.configure(yscrollcommand=scrollbary.set)
    
    scrollbary.pack(side="right", fill="y")
    scrollbarx.pack(side="bottom",fill="x")
    canvas.pack(side="left", fill="both", expand=True)
    
    ttk.Label(scrollable_frame,text="index").grid(row=0,column=0,ipadx=1,ipady=1)
    ttk.Label(scrollable_frame,text="User Name").grid(row=0,column=1,ipadx=1,ipady=1)
    ttk.Label(scrollable_frame,text="Program ID").grid(row=0,column=2,ipadx=1,ipady=1)
    ttk.Label(scrollable_frame,text="Program Name").grid(row=0,column=3,ipadx=1,ipady=1)
    ttk.Label(scrollable_frame,text="Program State").grid(row=0,column=4,ipadx=1,ipady=1)
    ttk.Label(scrollable_frame,text="Start Time").grid(row=0,column=5,ipadx=1,ipady=1)
    ttk.Label(scrollable_frame,text="End Time").grid(row=0,column=6,ipadx=1,ipady=1)
    
    for i in range(len(history_list)):
        programname="-UNKNOWN-"
        try:
            program = session.query(Program).filter_by(pid=history_list[i].pid).first()
            programname = program.pname
        except:
            session.rollback()
        ttk.Label(scrollable_frame,text=i+1).grid(row=i+1,column=0,ipadx=1,ipady=1)
        ttk.Label(scrollable_frame,text=history_list[i].username,).grid(row=i+1,column=1,ipadx=1,ipady=1)
        ttk.Label(scrollable_frame,text=history_list[i].pid,).grid(row=i+1,column=2,ipadx=1,ipady=1)
        ttk.Label(scrollable_frame,text=programname,).grid(row=i+1,column=3,ipadx=1,ipady=1)
        ttk.Label(scrollable_frame,text=history_list[i].pstate,).grid(row=i+1,column=4,ipadx=1,ipady=1)
        ttk.Label(scrollable_frame,text=history_list[i].pstart,).grid(row=i+1,column=5,ipadx=1,ipady=1)
        ttk.Label(scrollable_frame,text=history_list[i].pend,).grid(row=i+1,column=6,ipadx=1,ipady=1)
    
def control_games(_ = 0):
    try:
        game_list = session.query(Game).order_by(Game.gid.asc()).all()
    except:
        messagebox.showerror("Error","Couldn't Fetch The Game Table From The DB")
        session.rollback()
        return
    
    subwindow = Toplevel(window)
    subwindow.title("Games")
    subwindow.geometry("1920x1080")

    canvas = Canvas(subwindow)
    scrollable_frame = Frame(canvas)
    scrollable_frame.bind("<Configure>",lambda e: canvas.configure(scrollregion=canvas.bbox("all")))
    canvas.create_window((0, 0), window=scrollable_frame, anchor="nw")
    
    scrollbary = Scrollbar(subwindow, orient="vertical", command=canvas.yview)
    scrollbarx = Scrollbar(subwindow, orient="horizontal", command=canvas.xview)
    
    canvas.configure(xscrollcommand=scrollbarx.set)
    canvas.configure(yscrollcommand=scrollbary.set)
    
    scrollbary.pack(side="right", fill="y")
    scrollbarx.pack(side="bottom",fill="x")
    canvas.pack(side="left", fill="both", expand=True)
    
    ttk.Label(scrollable_frame,text="index").grid(row=0,column=0,ipadx=1,ipady=1)
    ttk.Label(scrollable_frame,text="Game Name").grid(row=0,column=1,ipadx=1,ipady=1)
    ttk.Label(scrollable_frame,text="Game Publisher").grid(row=0,column=2,ipadx=1,ipady=1)
    ttk.Label(scrollable_frame,text="Game Rate").grid(row=0,column=3,ipadx=1,ipady=1)
    ttk.Label(scrollable_frame,text="Game Genre").grid(row=0,column=4,ipadx=1,ipady=1)
    ttk.Label(scrollable_frame,text="Game Release Date").grid(row=0,column=5,ipadx=1,ipady=1)
    ttk.Label(scrollable_frame,text="Game ID").grid(row=0,column=6,ipadx=1,ipady=1)
    
    for i in range(len(game_list)):
        ttk.Label(scrollable_frame,text=i+1).grid(row=i+1,column=0,ipadx=1,ipady=1)
        ttk.Label(scrollable_frame,text=game_list[i].gname).grid(row=i+1,column=1,ipadx=1,ipady=1)
        ttk.Label(scrollable_frame,text=game_list[i].gpublisher).grid(row=i+1,column=2,ipadx=1,ipady=1)
        ttk.Label(scrollable_frame,text=game_list[i].grate).grid(row=i+1,column=3,ipadx=1,ipady=1)
        ttk.Label(scrollable_frame,text=game_list[i].ggenre).grid(row=i+1,column=4,ipadx=1,ipady=1)
        ttk.Label(scrollable_frame,text=game_list[i].greleaseddate).grid(row=i+1,column=5,ipadx=1,ipady=1)
        ttk.Label(scrollable_frame,text=game_list[i].gid).grid(row=i+1,column=6,ipadx=1,ipady=1)
        ttk.Button(scrollable_frame,text="Remove",command=lambda gid=game_list[i].gid: remove_game(gid)).grid(row=i+1,column=7,ipadx=1,ipady=1)

def control_programs(_ = 0):
    try:
        program_list = session.query(Program).order_by(Program.pid.asc()).all()
    except:
        messagebox.showerror("Error","Couldn't Fetch The Programs Table From The DB")
        session.rollback()
        return
    
    subwindow = Toplevel(window)
    subwindow.title("Programs")
    subwindow.geometry("1920x1080")

    canvas = Canvas(subwindow)
    scrollable_frame = Frame(canvas)
    scrollable_frame.bind("<Configure>",lambda e: canvas.configure(scrollregion=canvas.bbox("all")))
    canvas.create_window((0, 0), window=scrollable_frame, anchor="nw")
    
    scrollbary = Scrollbar(subwindow, orient="vertical", command=canvas.yview)
    scrollbarx = Scrollbar(subwindow, orient="horizontal", command=canvas.xview)
    
    canvas.configure(xscrollcommand=scrollbarx.set)
    canvas.configure(yscrollcommand=scrollbary.set)
    
    scrollbary.pack(side="right", fill="y")
    scrollbarx.pack(side="bottom",fill="x")
    canvas.pack(side="left", fill="both", expand=True)
    
    ttk.Label(scrollable_frame,text="index").grid(row=0,column=0,ipadx=1,ipady=1)
    ttk.Label(scrollable_frame,text="Program Name").grid(row=0,column=1,ipadx=1,ipady=1)
    ttk.Label(scrollable_frame,text="Program Publisher").grid(row=0,column=2,ipadx=1,ipady=1)
    ttk.Label(scrollable_frame,text="Program Release Date").grid(row=0,column=5,ipadx=1,ipady=1)
    ttk.Label(scrollable_frame,text="Program ID").grid(row=0,column=6,ipadx=1,ipady=1)
    
    for i in range(len(program_list)):
        ttk.Label(scrollable_frame,text=i+1).grid(row=i+1,column=0,ipadx=1,ipady=1)
        ttk.Label(scrollable_frame,text=program_list[i].pname).grid(row=i+1,column=1,ipadx=1,ipady=1)
        ttk.Label(scrollable_frame,text=program_list[i].ppublisher).grid(row=i+1,column=2,ipadx=1,ipady=1)
        ttk.Label(scrollable_frame,text=program_list[i].preleaseddate).grid(row=i+1,column=5,ipadx=1,ipady=1)
        ttk.Label(scrollable_frame,text=program_list[i].pid).grid(row=i+1,column=6,ipadx=1,ipady=1)
        ttk.Button(scrollable_frame,text="Remove",command=lambda pid=program_list[i].pid: remove_program(pid)).grid(row=i+1,column=7,ipadx=1,ipady=1)

def control_users(_ = 0):
    try:
        user_list = session.query(User).order_by(User.username.asc()).all()
    except:
        messagebox.showerror("Error","Couldn't Fetch The Users Table From The DB")
        session.rollback()
        return
    
    subwindow = Toplevel(window)
    subwindow.title("Users")
    subwindow.geometry("1920x1080")

    canvas = Canvas(subwindow)
    scrollable_frame = Frame(canvas)
    scrollable_frame.bind("<Configure>",lambda e: canvas.configure(scrollregion=canvas.bbox("all")))
    canvas.create_window((0, 0), window=scrollable_frame, anchor="nw")
    
    scrollbary = Scrollbar(subwindow, orient="vertical", command=canvas.yview)
    scrollbarx = Scrollbar(subwindow, orient="horizontal", command=canvas.xview)
    
    canvas.configure(xscrollcommand=scrollbarx.set)
    canvas.configure(yscrollcommand=scrollbary.set)
    
    scrollbary.pack(side="right", fill="y")
    scrollbarx.pack(side="bottom",fill="x")
    canvas.pack(side="left", fill="both", expand=True)
    
    ttk.Label(scrollable_frame,text="index").grid(row=0,column=0,ipadx=1,ipady=1)
    ttk.Label(scrollable_frame,text="Full Name").grid(row=0,column=1,ipadx=1,ipady=1)
    ttk.Label(scrollable_frame,text="Email").grid(row=0,column=2,ipadx=1,ipady=1)
    ttk.Label(scrollable_frame,text="Type").grid(row=0,column=3,ipadx=1,ipady=1)
    ttk.Label(scrollable_frame,text="Online").grid(row=0,column=4,ipadx=1,ipady=1)
    ttk.Label(scrollable_frame,text="Locked").grid(row=0,column=5,ipadx=1,ipady=1)
    ttk.Label(scrollable_frame,text="UserName").grid(row=0,column=6,ipadx=1,ipady=1)
    
    for i in range(len(user_list)):
        ttk.Label(scrollable_frame,text=i+1).grid(row=i+1,column=0,ipadx=1,ipady=1)
        ttk.Label(scrollable_frame,text=user_list[i].firstname+' '+user_list[i].lastname).grid(row=i+1,column=1,ipadx=1,ipady=1)
        ttk.Label(scrollable_frame,text=user_list[i].email).grid(row=i+1,column=2,ipadx=1,ipady=1)
        ttk.Label(scrollable_frame,text=user_list[i].usertype).grid(row=i+1,column=3,ipadx=1,ipady=1)
        ttk.Label(scrollable_frame,text=user_list[i].isonline).grid(row=i+1,column=4,ipadx=1,ipady=1)
        ttk.Label(scrollable_frame,text=user_list[i].islocked).grid(row=i+1,column=5,ipadx=1,ipady=1)
        ttk.Label(scrollable_frame,text=user_list[i].username).grid(row=i+1,column=6,ipadx=1,ipady=1)
        ttk.Button(scrollable_frame,text="Lock",command=lambda username=user_list[i].username : lock_user(username),state='disabled' if user_list[i].islocked else 'normal').grid(row=i+1,column=7,ipadx=1,ipady=1)
        ttk.Button(scrollable_frame,text="Unlock",command=lambda username=user_list[i].username : unlock_user(username),state='normal' if user_list[i].islocked else 'disabled').grid(row=i+1,column=8,ipadx=1,ipady=1)
        ttk.Button(scrollable_frame,text="Remove",command=lambda username=user_list[i].username : remove_user(username)).grid(row=i+1,column=9,ipadx=1,ipady=1)

def remove_user(username):
    try:
        user = session.query(User).filter_by(username=username).first()
        session.delete(user)
        session.commit()
        messagebox.showinfo("Success","{}'s Account Has Been Deleted".format(username))
        logger("Removed","User:[{}]'s Account".format(username))
    except:
        messagebox.showerror("Error","Couldn't Delete {}'s Account".format(username))
        session.rollback()

def remove_game(gid):
    try:
        game = session.query(Game).filter_by(gid=gid).first()
        session.delete(game)
        session.commit()
        messagebox.showinfo("Success","Game : {}\nOf ID : {}\nHas Been Deleted Successfully".format(game.gname,game.gid))
        logger("Removed","Game:[{}] of ID:[{}]".format(game.gname,game.gid))
    except:
        messagebox.showerror("Error","Operation Failed")
        session.rollback()

def remove_program(pid):
    try:
        program = session.query(Program).filter_by(pid=pid).first()
        session.delete(program)
        session.commit()
        messagebox.showinfo("Success","Program : {}\nOf ID : {}\nHas Been Deleted Successfully".format(program.pname,program.pid))
        logger("Removed","Program:[{}] of ID:[{}]".format(program.pname,program.pid))
    except:
        messagebox.showerror("Error","Operation Failed")
        session.rollback()

def lock_user(username):
    try:
        user = session.query(User).filter_by(username=username).first()
        user.islocked = True
        session.commit()
        messagebox.showinfo("Success","{}'s Account Has Been Locked".format(username))
        logger("Locked","User:[{}]'s Account".format(username))
    except:
        messagebox.showerror("Error","Couldn't Lock {}'s Account, Please Check the Connection With The DB, Or Try Reopening The Panel".format(username))
        session.rollback()
        
def unlock_user(username):
    try:
        user = session.query(User).filter_by(username=username).first()
        user.islocked = False
        session.commit()
        messagebox.showinfo("Success","{}'s Account Has Been Unlocked".format(username))
        logger("Unlocked","User:[{}]'s Account".format(username))
    except:
        messagebox.showerror("Error","Couldn't Unlock {}'s Account, Please Check the Connection With The DB, Or Try Reopening The Panel".format(username))
        session.rollback()

def is_sudo():
    if USERNAME == 'admin':
        return "normal"
    else:
        return "disabled"

def add_admin(username,password):
    try:
        admin_ins = Admin(username,password)
        session.add(admin_ins)
        session.commit()
        messagebox.showinfo("Success","Admin {} Has Been Added Successfully".format(admin_ins.username))
        logger("Added","Admin:[{}]".format(admin_ins.username))
    except:
        messagebox.showerror("Error","Couldn't Add Admin {} To The DB".format(username))
        session.rollback()

def view_admin():
    try:
        admin_list = [session.query(Admin).filter_by(username='admin').first()]
        admin_list += session.query(Admin).filter(Admin.username!='admin').all()
    except:
        messagebox.showerror("Error","Couldn't Fetch The Admins' Table From The DB")
        session.rollback()
        return
    
    subwindow = Toplevel(window)
    subwindow.title("Admins")
    subwindow.geometry("450x600+400+200")

    canvas = Canvas(subwindow)
    scrollable_frame = Frame(canvas)
    scrollable_frame.bind("<Configure>",lambda e: canvas.configure(scrollregion=canvas.bbox("all")))
    canvas.create_window((0, 0), window=scrollable_frame, anchor="nw")
    
    scrollbary = Scrollbar(subwindow, orient="vertical", command=canvas.yview)
    scrollbarx = Scrollbar(subwindow, orient="horizontal", command=canvas.xview)
    
    canvas.configure(xscrollcommand=scrollbarx.set)
    canvas.configure(yscrollcommand=scrollbary.set)
    
    scrollbary.pack(side="right", fill="y")
    scrollbarx.pack(side="bottom",fill="x")
    canvas.pack(side="left", fill="both", expand=True)
    
    ttk.Label(scrollable_frame,text="index").grid(row=0,column=0,ipadx=1,ipady=1)
    ttk.Label(scrollable_frame,text="UserName").grid(row=0,column=1,ipadx=1,ipady=1)
    
    for i in range(len(admin_list)):
        ttk.Label(scrollable_frame,text=i+1).grid(row=i+1,column=0,ipadx=1,ipady=1)
        ttk.Label(scrollable_frame,text=admin_list[i].username,).grid(row=i+1,column=1,ipadx=1,ipady=1)
        ttk.Button(scrollable_frame,text="Remove",command=lambda username=admin_list[i].username: remove_admin(username)).grid(row=i+1,column=7,ipadx=1,ipady=1)

def remove_admin(username):
    if username=='admin':
        messagebox.showinfo("Unsupported Operation","You Cannot Remove The Top-User From The DB")
        return
    try:
        admin_ins = session.query(Admin).filter_by(username=username).first()
        session.delete(admin_ins)
        session.commit()
        messagebox.showinfo("Success","Admin {} Has Been Removed Successfully".format(admin_ins.username))
        logger("Removed","Admin:[{}]".format(admin_ins.username))
    except:
        messagebox.showerror("Error","Couldn't Remove Admin {} From The DB".format(username))
        session.rollback()

def change_admin(username,password):
    try:
        admin_ins = session.query(Admin).filter_by(username=username).first()
        admin_ins.password = password
        session.commit()
        messagebox.showinfo("Success","Admin {}'s Passwrod Has Been Updated Successfully".format(admin_ins.username))
        logger("Changed",'Password For Admin:[{}]'.format(admin_ins.username))
    except:
        messagebox.showerror("Error","Couldn't Change {}'s Password".format(username))
        session.rollback()

def check_admin(username,password,engine):
    '''fucntion to check whether the admin password is right and launches the admin control'''
    try:
        global session
        session = sessionmaker(bind=engine)()
        admin_ins = session.query(Admin).filter_by(username=username,password=password).first()
        if admin_ins:
            global USERNAME
            USERNAME = admin_ins.username
            admin_control()
        else:
            messagebox.showerror("Error","Username Or Password Isn't Correct, Please Try Again")
    except:
        messagebox.showerror("Error","Connection Failed")
        session.rollback()

def login():
    '''function to authenticate the user in case of successful connection to the DB'''
    clear_window(window)
    window.geometry("700x250+480+265")
    enter_admin_name_label = ttk.Label(window,text="Enter Admin Username : ")
    enter_admin_name_label.grid(column = 0,row = 0,padx=(70,0),pady=(70,0)) 

    admin_name_input = ttk.Entry(window,width=35,)
    #admin_name_input.insert(0,"admin") # comment this after testing
    admin_name_input.grid(column =1,row = 0,pady=(70,0))
    
    enter_password_label = ttk.Label(window,text="Enter Admin Password : ")
    enter_password_label.grid(column = 0,row = 1,padx=(70,0),pady=(20,0)) 

    admin_password_input = ttk.Entry(window,width=35,show='\u25CF')
    #admin_password_input.insert(0,"0000") # comment this after testing
    admin_password_input.grid(column =1,row = 1,pady=(20,0))
    
    admin_checker = lambda dump = 0 : check_admin(admin_name_input.get(),admin_password_input.get(),engine)

    admin_login_button = ttk.Button(window,text="Log in",command=admin_checker)
    admin_login_button.bind("<Return>",admin_checker)
    admin_login_button.grid(column = 1 ,row =2,pady=30)

def connect_db(host,port,user,password):
    '''function that uses alchmey to connect to the database given its attributes'''
    try:
        global engine
        engine = create_engine('mysql+pymysql://{}:{}@{}:{}/HFB'.format(user,password,host,port))
        if len(engine.table_names()):
            login()
        else:
            messagebox.showerror("Error","Couldn't Connect to HoostForBoost DB")
    except:
        messagebox.showerror("Error","Couldn't Connect to HoostForBoost DB")

def start():
    '''function that draws the welcome screen'''
    host_label = ttk.Label(window,text="Host : ")
    host_label.grid(row=0,column=0,padx=(60,0),pady=(50,0))
    
    host_input = ttk.Entry(window,)
    host_input.insert(0,'127.0.0.1')
    host_input.grid(row=0,column=1,padx=(0,0),pady=(50,0))
    
    port_label = ttk.Label(window,text="Port : ")
    port_label.grid(row=1,column=0,padx=(60,0),pady=(20,0))
    
    port_input = ttk.Entry(window,)
    port_input.insert(0,'3306')
    port_input.grid(row=1,column=1,padx=(0,0),pady=(20,0))
    
    user_label = ttk.Label(window,text="User : ")
    user_label.grid(row=2,column=0,padx=(60,0),pady=(20,0))
    
    user_input = ttk.Entry(window,)
    #user_input.insert(0,'omar')
    user_input.grid(row=2,column=1,padx=(0,0),pady=(20,0))

    password_label = ttk.Label(window,text="Password : ")
    password_label.grid(row=3,column=0,padx=(60,0),pady=(20,0))
    
    password_input = ttk.Entry(window,show="\u25CF")
    #password_input.insert(0,'0000') # comment this line after testing
    password_input.grid(row=3,column=1,padx=(0,0),pady=(20,0))
    
    connect = lambda dump = 0 : connect_db(host_input.get(),port_input.get(),user_input.get(),password_input.get()) 
    
    connect_button = ttk.Button(window,text=" Connect ",command=connect,)
    connect_button.bind("<Return>",connect)
    connect_button.grid(row=4,column=1,pady=30)

def clear_window(window):
    '''just a window cleaner'''
    for widget in window.winfo_children():
            widget.destroy()
            
def logger(action,info):
    try:
        with open('log','a') as file:
            file.write('[{}] Admin:[{}] {} {}\n'.format(time.ctime(),USERNAME,action,info,))
    except:
        pass
        
if __name__ == '__main__':
    
    window = Tk()
    
    USERNAME = ''
    engine = ''
    session = ''
    
    window.title('HFB Administration Panel')
    
    start()
    
    window.geometry('400x300+480+265')
    window.mainloop()